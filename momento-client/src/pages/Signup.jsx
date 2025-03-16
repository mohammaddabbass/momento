import React, { useEffect, useState } from 'react';
import "../css/pages/login.css"; 
import Form from '../components/form';
import { useNavigate } from 'react-router-dom';
import { signup } from '../utils/remote/axios';
import { requestMethods } from '../utils/enums/request.methods';

const Signup = () => {

  const [credentails, setCredentials] = useState({
    email: "",
    username: "",
    password: "",
  })

  const navigate = useNavigate();

  useEffect(() => {
    if(!credentails.email.includes("@")) {
      console.log("Email Invalid");
    }
  }, [credentails]);

  const handleSignup = async () => {
    const response = await signup({
      method: requestMethods.POST,
      route: '/register',
      body: credentails,
    });

    if(!response.error) {
      console.log(response);
      navigate('/');
    } else {
      console.log(response.error);
    }
  }

  return (
    <div className='login-signup-page'>
    <Form title={'Welcome to Momento'} caption={"Preserve Your Precious Memories"} text={"Already have a memory box?"} link={"Login"} name={"signup"} isSignup={true} linkPath={"/login"}  credentials={credentails} setCredentials={setCredentials} onsubmit={handleSignup}/>
    </div>
  );
};

export default Signup;