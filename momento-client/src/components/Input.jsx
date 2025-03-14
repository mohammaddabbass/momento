import React from "react";

const Input = ({label, type, placeholder, defaultValue =  ''}) => {
    return (
        <div className="form-group">
            <label  htmlFor="">{label}</label>
            <input defaultValue={defaultValue} className='input-field' type={type} placeholder={placeholder}/>
        </div>
    );
}

export default Input;