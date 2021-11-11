//TODO po vymazani ingrediencie ju treba vymazat aj z receptu

import {param, validationResult} from "express-validator"
//import bodyParser from "body-parser"
import sequelize from "../models";

async function getAllIngredients (req, res){
    try{
        const recipes = await req.context.models.ingredient.findAll()
        //throw new Error('some bad stuff happend')
        res.send(recipes)
        //res.sendStatus(200)
    } catch(error){
        console.log('error',error)
        res.sendStatus(500)
    }
}

async function getFilteredIngredient (req, res){
    try{
        const results = validationResult(req)
        if(results.isEmpty()){
            console.log(req.params)
            const filteredIngredients = await req.context.models.ingredient.findAll({
            where: {id: req.params.id},
            })
            
            if(filteredIngredients.length==0){
                throw new Error('Not found in db')
            }
            else{
                res.send(filteredIngredients)
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

async function addIngredient (req, res){
    try{
        await sequelize.models.ingredient.bulkCreate([
            {
                title: req.body.title,
                unit: req.body.unit,
            }
    ]);
    res.sendStatus(200)
    } catch(error){
        console.log('Error when inserting to DB: ',error)
        res.sendStatus(500)
    }

   
}

async function removeIngredient (req, res){
    try{
        const results = validationResult(req)
        if(results.isEmpty()){
            await req.context.models.ingredient.destroy({
                where: {id: req.params.id},
            })
    
            await req.context.models.recipeIngredients.destroy({
                where: {ingredientId: req.params.id},
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

async function editIngredient (req, res){
    try{
        await sequelize.models.ingredient.update({
            title: req.body.ingredient.title,
            unit: req.body.ingredient.unit,
        },
        {
            where: {id: req.body.ingredient.id}
        });

        
        res.sendStatus(200)
    } catch(error){
        console.log('Error when editing ingredient in DB: ',error)
        res.sendStatus(500)
    }

      
}

export default {getAllIngredients, getFilteredIngredient, addIngredient, removeIngredient,editIngredient}