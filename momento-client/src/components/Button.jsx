import React from 'react';
import "../css/components/buttons.css"; 

const Button = ({text, variant = "primary", onClick }) => {
  return (
    <button onClick={onClick} className= {`btn ${variant}`}>
        {text}
    </button>
  );
};

export default Button;