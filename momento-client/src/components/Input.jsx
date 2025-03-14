import React from "react";

const Input = ({label, type, placeholder}) => {
    return (
        <div className="form-group">
            <label  htmlFor="">{label}</label>
            <input className='input-field' type={type} placeholder={placeholder}/>
        </div>
    );
}

export default Input;