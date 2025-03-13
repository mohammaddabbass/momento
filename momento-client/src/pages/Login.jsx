import React from 'react';
import "../css/pages/login.css"; 
import Form from '../components/form';


const Login = () => {
  return (
    <div className='login-signup-page'>
    <Form title={'Welcome Home!'} caption={'Your memories await'} text={"First time here?"} link={"Create your memory box"} name={"login"} isSignup={false}/>
    </div>
  );
};

export default Login;