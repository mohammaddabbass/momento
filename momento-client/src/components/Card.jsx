import React from "react";
import "../css/components/card.css"; 

const Card = ({ image, title }) => {
  return (
    <div className="card">
      <img src={image} alt={title} />
      <div className="card-content">
        <h3>{title}</h3>
      </div>
    </div>
  );
};

export default Card;