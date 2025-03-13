import React from 'react';
import "../css/components/forms.css"; 
import Button from './Button';
import Input from './Input';
import { Link } from 'react-router-dom';

const Form = ({title, caption, text, link, isSignup, name, linkPath }) => {
    const handleClick = () => {
        console.log("Button clicked!");
      };

  return (
    <div className={`form-container flex column ${name}`}>
        <h1>{title}</h1>
        <h3>{caption}</h3>
        <Input type={'text'} label={"Email"} placeholder={"example@gmail.com"}/>
        {isSignup && <Input type={'text'} label={"Username"} placeholder={"Example-name"} />}
        <Input type={'password'} label={"Password"} placeholder={"eg. abc123"}/>
        <Button text= "login" onClick={handleClick}/>
        <p>{text} <Link to={linkPath} className="link">{link}</Link></p>
    </div>
  );
};

export default Form;