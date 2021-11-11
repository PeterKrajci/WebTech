import Sequelize from "sequelize";

import category from "./category"
import recipe from "./recipe";
import ingredient from "./ingredient";

function applyRelations(sequelize) {
  const { ingredient, recipe, category} = sequelize.models;


  ingredient.belongsToMany(recipe, { through: "recipeIngredients" });
  recipe.belongsToMany(ingredient, { through: "recipeIngredients" });

  category.belongsToMany(recipe, { through: "recipeCategory" });
  recipe.belongsToMany(category, { through: "recipeCategory" });
}

const sequelize = new Sequelize({
  dialect: "sqlite",
  storage: 'db.sqlite', //process.env.DATABASE_PATH
  logging: false,
});

const models = [recipe, ingredient, category];

models.forEach((model) => model(sequelize));

applyRelations(sequelize);

export default sequelize;
