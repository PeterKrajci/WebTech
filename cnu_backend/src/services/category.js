import {param, validationResult} from "express-validator"
import bodyParser from "body-parser"
import sequelize from "../models";

async function getAllCategories (req, res){
    try{
        const categories = await req.context.models.category.findAll()
        //throw new Error('some bad stuff happend')
        res.send(categories)
    } catch(error){
        console.log('error',error)
        res.sendStatus(500)
    }
}

async function getFilteredCategory (req, res){
    try{
        const results = validationResult(req)
        if(results.isEmpty()){
            console.log(req.params)
            const filteredCategory = await req.context.models.category.findAll({
            where: {id: req.params.id},
            })
            
            if(filteredCategory.length==0){
                throw new Error('Not found in db')
            }
            else{
                res.send(filteredCategory)
            }
        
        }
        else{
            throw new Error('validationError')

        }
        
    } catch(error){
        console.log('error',error)
        res.sendStatus(500)        
    }
}




async function addCategory (req, res){
    try{
        await sequelize.models.category.bulkCreate([
            {
                title: req.body.title,
                text: req.body.text,
            }
       
    ]);
    res.sendStatus(200)
    } catch(error){
        console.log('Error when inserting to DB: ',error)
        res.sendStatus(500)
    }

   
}

async function editCategory (req, res){
    try{
        await sequelize.models.category.update({
            title: req.body.category.title,
            text: req.body.category.text,
        },
        {
            where: {id: req.body.category.id}
        });

        
        res.sendStatus(200)
    } catch(error){
        console.log('Error when editing catagory in DB: ',error)
        res.sendStatus(500)
    }

      
}

async function removeCategory (req, res){
    try{
        const results = validationResult(req)
        if(results.isEmpty()){
            await req.context.models.category.destroy({
                where: {id: req.params.id},
            })
    
            await req.context.models.recipeCategory.destroy({
                where: {categoryId: req.params.id},
            })
        }
        else{
            throw new Error('validationError')
        }

        res.sendStatus(200)
    } catch(error){
        console.log('Error when deleting from DB: ',error)
        res.sendStatus(500)
    }

   
}

async function addCategoriesToRecipe (req, res){
    try{
        

        await req.context.models.recipeCategory.destroy({
            where: {recipeId: req.body.recipe.id},
        })

        
        const categID = [];
        var obj;
        req.body.categoriesId.forEach(element => {
            obj = {
                recipeId: req.body.recipe.id,
                categoryId: element,
            }
            
            categID.push(obj)
        });

        await sequelize.models.recipeCategory.bulkCreate(categID);
        res.sendStatus(200)
    } catch(error){
        console.log('Error when inserting to DB: ',error)
        res.sendStatus(500)
    }

    
    
      
}

export default {getAllCategories, addCategory, editCategory, addCategoriesToRecipe, getFilteredCategory, removeCategory}
