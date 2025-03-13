import React from 'react';
import "../css/pages/login.css"; 
import Form from '../components/form';

const Signup = () => {
  return (
    <div className='login-signup-page'>
    <Form title={'Welcome to Momento'} caption={"Preserve Your Precious Memories"} text={"Already have a memory box?"} link={"Login"} name={"signup"} isSignup={true}/>
    </div>
  );
};

export default Signup;