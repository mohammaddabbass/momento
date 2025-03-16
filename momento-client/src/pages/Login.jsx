import React, { useEffect, useState } from 'react';
import "../css/pages/login.css"; 
import Form from '../components/form';
import { useNavigate } from 'react-router-dom';
import { login } from '../utils/remote/axios';
import { requestMethods } from '../utils/enums/request.methods';


const Login = () => {
  const [credentails, setCredentials] = useState({
    email: "",
    password: "",
  })

  const navigate = useNavigate();

  useEffect(() => {
    if(!credentails.email.includes("@")) {
      console.log("Email Invalid");
    }
  }, [credentails]);

  const handleLogin = async () => {
    const response = await login({
      method: requestMethods.POST,
      route: '/login',
      body: credentails,
    });

    if(!response.error) {
      console.log(response);
      localStorage.setItem("user_id", response.user.id);
      navigate('/');
    } else {
      console.log(response.error);
    }
  }

  return (
    <div className='login-signup-page'>
    <Form title={'Welcome Home!'} caption={'Your memories await'} text={"First time here?"} link={"Create your memory box"} name={"login"} isSignup={false} linkPath={"/signup"} credentials={credentails} setCredentials={setCredentials} onsubmit={handleLogin}/>
    </div>
  );
};

export default Login;