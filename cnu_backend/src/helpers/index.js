import sequelize from "../models";

export async function populateDB() {

  await sequelize.models.category.bulkCreate([
    {
      title: "Meat meals",
      text: "Simple description 1",
    },
    {
      title: "Pasta meals",
      text: "Simple description 2",
    }
  ]);


  await sequelize.models.ingredient.bulkCreate([
    {
      title: "salt",
      unit: "g",
    },
    {
      title: "water",
      unit: "ml",
    },
    {
      title: "meat",
      unit: "g",
    },
    {
      title: "flour",
      unit: "g",
    },
  ]);
  // const ingredients = await sequelize.models.ingredient.findAll();
  await sequelize.models.recipe.bulkCreate([
    {
      title: "Simple stew",
      text: "Just put meat into water with salt",
      rating: 5
    },
  ]);
  await sequelize.models.recipeIngredients.bulkCreate([
    {
      recipeId: 1,
      ingredientId: 1,
    },
    {
      recipeId: 1,
      ingredientId: 2,
    },
    {
      recipeId: 1,
      ingredientId: 3,
    },
  ]);

  await sequelize.models.recipeCategory.bulkCreate([
    {
      recipeId: 1,
      categoryId: 1,
    },
  ]);

  // const recipesWithIngredients = await sequelize.models.recipe.findAll({
  //   include: [{ model: sequelize.models.ingredient, as: "ingredients" }],
  // });
}
