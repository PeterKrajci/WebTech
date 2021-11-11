import {param, validationResult} from "express-validator" 
import sequelize from "../models";

async function getAllRecipes (req, res){
    try{
        console.log(req)
        const recipes = await req.context.models.recipe.findAll({
            include: [{model: req.context.models.ingredient}, {model: req.context.models.category}]
        })
        //throw new Error('some bad stuff happend')
        res.send(recipes)
        //res.sendStatus(200)
    } catch(error){
        req.log.error(error)

        console.log('error',error)
        res.sendStatus(500)
    }

}
//premenovat na recipe
async function getFilteredRecipes (req, res){
    try{
        const results = validationResult(req)
        if(results.isEmpty()){
           // console.log(req)
            const filteredRecipes = await req.context.models.recipe.findAll({
            where: {title: req.params.title},
            include: [{model: req.context.models.ingredient},{model: req.context.models.category}]
            })
            if(filteredRecipes.length==0){
                res.status(404)
                res.send('Not found in DB') //???

            }
            else{
                res.send(filteredRecipes)

            }
            
            //res.sendStatus(200)
            //throw new Error('some bad stuff happend')
        
        }
        else{
            req.log.info(`validation error value: ${req.params.title}`)
            res.status(400)
            res.send('validationError')

        }
        
    } catch(error){
        req.log.error(error)
        //console.log('error',error)
        res.sendStatus(500)
    }

}

async function addRecipe (req, res){
    try{
        await sequelize.models.recipe.bulkCreate([
        {
            title: req.body.recipe.title,
            text: req.body.recipe.text,
            rating: req.body.recipe.rating
        },
        ]);
        const recipe = await sequelize.models.recipe.findAll({
        where: {title: req.body.recipe.title},
        raw: true,
        //nest: true,
        });

        const ingrID = [];
        var obj;
        req.body.ingredientsId.forEach(element => {
            obj = {
                recipeId: recipe[0].id,
                ingredientId: element,
            }
            
            ingrID.push(obj)
        });
        //console.log(ingrID)
        await sequelize.models.recipeIngredients.bulkCreate(ingrID);
        res.sendStatus(200)
    } catch(error){
        console.log('Error when inserting to DB: ',error)
        res.sendStatus(500)
    }
}

async function removeRecipe (req, res){
    try{
        await req.context.models.recipe.destroy({
            where: {id: req.params.id},
        })

        await req.context.models.recipeIngredients.destroy({
            where: {recipeId: req.params.id},
        })
        
        res.sendStatus(200)
        console.log('Deleted')
    } catch(error){
        console.log('Error when removing from DB: ',error)
        res.sendStatus(500)
    }

   
}

async function updateRecipe (req, res){
    try{
        await sequelize.models.recipe.update({
            title: req.body.recipe.title,
            text: req.body.recipe.text,
        },
        {
            where: {id: req.body.recipe.id}
        }
        );

        await req.context.models.recipeIngredients.destroy({
            where: {recipeId: req.body.recipe.id},
        })


        const ingrID = [];
        var obj;
        req.body.ingredientsId.forEach(element => {
            obj = {
                recipeId: req.body.recipe.id,
                ingredientId: element,
            }
            
            ingrID.push(obj)
        });

        await sequelize.models.recipeIngredients.bulkCreate(ingrID);
        res.sendStatus(200)
    } catch(error){
        console.log('Error when inserting to DB: ',error)
        res.sendStatus(500)
    }


    
    
      
}
async function editRating (req, res){
    try{
        await sequelize.models.recipe.update({
            rating: req.body.recipe.rating,
        },
        {
            where: {id: req.body.recipe.id}
        }
        );

        
        res.sendStatus(200)
    } catch(error){
        console.log('Error when inserting to DB: ',error)
        res.sendStatus(500)
    }

    
    
    
      
}


export default {getAllRecipes, getFilteredRecipes, addRecipe, removeRecipe, updateRecipe, editRating}