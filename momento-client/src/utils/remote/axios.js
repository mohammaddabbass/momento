import axios from "axios";

const base_url = "http://localhost/momento/momento-server";

export const login = async ({method, route, body,}) => {
    try {
        const response = await axios.request({
            method,
            headers: {
                "Content-Type": "application/json",
            },
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