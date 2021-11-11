import Sequelize from "sequelize";

const { DataTypes } = Sequelize;

const recipe = (sequelize) => {
  const recipe = sequelize.define("recipe", {
    title: {
      type: DataTypes.STRING(100),
      allowNull: false,
      validate: {
        notEmpty: true,
      },
    },
    text: {
      type: DataTypes.STRING,
    },
    rating: {
      type: DataTypes.INTEGER,
      allowNull: false,
      validate: {
        notEmpty: true,
        min: 1,
        max: 5,
      },
    }
  });

  return recipe;
};

export default recipe;
