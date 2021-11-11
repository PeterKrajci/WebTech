import express from "express"
import {param, validationResult} from "express-validator"  //???
import services from "../services"

const router = express.Router()

router.get('/', services.recipe.getAllRecipes)
router.get('/:title', param('title').isLength({min:2, max:50}), services.recipe.getFilteredRecipes)
router.post('/addRecipe', services.recipe.addRecipe)
router.delete('/removeRecipe/:id',param('id').isInt(), services.recipe.removeRecipe)
router.put('/updateRecipe', services.recipe.updateRecipe)
router.put('/editRating', services.recipe.editRating)


export default router