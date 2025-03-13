import React from 'react';
import "../css/components/forms.css"; 
import Button from './button';

const Form = () => {
    const handleClick = () => {
        console.log("Button clicked!");
      };

  return (
    <div className='form-container flex column'>
        <h1>Welcome Home!</h1>
        <h3>Your memories await</h3>
        <div className="form-group">
            <label  htmlFor="">Email</label>
            <input className='input-field' type="text" placeholder='example@email.com'/>
        </div>
        <div className="form-group">
            <label htmlFor="">Password</label>
            <input className='input-field' type="password" placeholder='abc123'/>
        </div>
        <Button text= "login" onClick={handleClick}/>
        <p>First time here? <a href="">Create your memory box</a></p>
    </div>
  );
};

export default Form;