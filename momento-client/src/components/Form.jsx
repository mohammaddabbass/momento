import React from 'react';
import "../css/components/forms.css"; 
import Button from './Button';
import Input from './Input';
import { Link } from 'react-router-dom';

const Form = ({title, caption, text, link, isSignup, name, linkPath, credentials, setCredentials, onsubmit }) => {
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setCredentials(prev => ({
      ...prev,
      [name]: value,
    }));
  };

  return (
    <div className={`form-container flex column ${name}`}>
        <h1>{title}</h1>
        <h3>{caption}</h3>
        <Input type={'text'} label={"Email"} placeholder={"example@gmail.com"} name = {"email"} value= {credentials.email || ''} onChange= {handleInputChange}/>
        {isSignup && <Input type={'text'} label={"Username"} placeholder={"Example-name"} name={"username"} value={credentials.username || ''} onChange={handleInputChange}/>}
        <Input type={'password'} label={"Password"} placeholder={"eg. abc123"} name = {"password"} value= {credentials.password || ''} onChange= {handleInputChange}/>
        <Button text= {name} onClick={onsubmit}/>
        <p>{text} <Link to={linkPath} className="link">{link}</Link></p>
    </div>
  );
};

export default Form;