import express from "express"
import {param, validationResult} from "express-validator"
import services from "../services"

const router = express.Router()

router.get('/', services.category.getAllCategories)
router.get('/:id', param('id').isInt(), services.category.getFilteredCategory)
router.post('/addCategory', services.category.addCategory)
router.put('/editCategory', services.category.editCategory)
router.delete('/removeCategory/:id', param('id').isInt(), services.category.removeCategory)
router.post('/addCatToRec', services.category.addCategoriesToRecipe)
export default router