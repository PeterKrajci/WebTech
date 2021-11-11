import express from "express"
import {param, validationResult} from "express-validator"
import services from "../services"

const router = express.Router()

router.get('/', services.ingredient.getAllIngredients)
router.get('/:id', param('id').isInt(), services.ingredient.getFilteredIngredient)
router.post('/addIngredient', services.ingredient.addIngredient)
router.put('/editIngredient', services.ingredient.editIngredient)
router.delete('/removeIngredient/:id', param('id').isInt(), services.ingredient.removeIngredient)
export default router