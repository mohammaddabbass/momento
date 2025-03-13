import React from "react";
import Card from "./Card";

const CardsContainer = ({ cards }) => {
  return (
    <div className="cards-container">
      {cards.map((card, index) => (
        <Card key={index} image={card.image} title={card.title} description={card.description} />
      ))}
    </div>
  );
};

export default CardsContainer;