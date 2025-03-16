import axios from "axios";

const base_url = "http://localhost/momento/momento-server";
const req_headers = {
    "Content-Type": "application/json",
}

export const login = async ({method, route, body,}) => {
    try {
        const response = await axios.request({
            method,
            headers: req_headers,
            url: base_url + route,  
            data: body
        });

        return response.data;
    } catch (error) {
        console.log(error);
        return {
            error: true,
            message: error.message,
        }
    }
}

export const signup = async ({method, route ,body}) => {
    try {
        const response = await axios.request({
            method,
            url: base_url + route,
            headers: req_headers,
            data: body
        });

        return response.data;
    } catch (error) {
        console.log("error");
        console.log(error);
        return{
            error: true,
            message: error.message,
    }
    }
}