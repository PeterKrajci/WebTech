import Sequelize from "sequelize";

const { DataTypes } = Sequelize;

const category = (sequelize) => {
  const category = sequelize.define("category", {
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
  });

  return category;
};

export default category;
