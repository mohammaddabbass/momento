import React from 'react';
import "../css/components/header.css"; 
import Input from './Input';
import Button from './Button';

const Header = () => {
  return (
    <>
    <header className="header flex align-items justify-content">
        <a href="#" className="logo">Momento</a>
        
        <div className="nav-container flex align-items justify-content">
            <input type="search" 
                   className="search-bar" 
                   placeholder="Search memories..."/>
            
            <Button text={"upload"}/>
            <Button text={"Logout"} variant='primary-outline'/>
        </div>
    </header>
    </>
  );
};

export default Header;