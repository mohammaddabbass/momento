import React from "react";

const Input = ({label, type, placeholder, name, value, onChange}) => {
    return (
        <div className="form-group">
            <label  htmlFor="">{label}</label>
            <input  className='input-field' type={type} placeholder={placeholder} name={name} value={value} onChange={onChange}/>
        </div>
    );
}

export default Input;