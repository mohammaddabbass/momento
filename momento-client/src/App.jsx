// import './App.css'
import Login from "./pages/Login.jsx";
import Home from "./pages/home.jsx";
import PhotoDetails from "./pages/PhotoDetails.jsx";
import Upload from "./pages/Upload.jsx";
import './css/main.css';
import Signup from "./pages/Signup.jsx";
import { BrowserRouter, Routes, Route } from "react-router-dom";

function App() {

  return (
    <BrowserRouter>
      <Routes>
        {/* <Route path="/auth"> */}

        <Route path="/" element= {<Home/>}></Route>
        <Route path="/login" element= {<Login/>}></Route>
        <Route path="/signup" element = {<Signup/>}></Route>
        <Route path="/photo" element = {<PhotoDetails/>}></Route>
        <Route path="/upload" element = {<Upload/>}></Route>
        {/* </Route> */}
      </Routes>  
    </BrowserRouter>
  )
}

export default App;
