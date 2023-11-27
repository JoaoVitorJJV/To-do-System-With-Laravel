const BASE_URL = "http://localhost:8989";

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json"
}

export const login = async (email, password) => {
    const req = await fetch(`${BASE_URL}/signin`, {
        method: "POST",
        headers,
        body: JSON.stringify({
            email, password
        })
    });

    const res = await req.json();

    return res;
}

export const register = async (email, name, password) => {
    const req = await fetch(`${BASE_URL}/user`, {
        method: "POST",
        headers,
        body: JSON.stringify({
            email, password, name
        })
    });

    const res = await req.json();

    return res;
}

export const createTask = async (data) => {
    const req = await fetch(`${BASE_URL}/task/new`, {
        method: "POST",
        headers,
        body: JSON.stringify(data)
    });

    const res = await req.json();

    return res;
}

export const getTaskByUserId = async (id) => {
    const req = await fetch(`${BASE_URL}/task/createdby/${id}`, {
        method: "GET",
        headers
    });

    const res = await req.json();

    return res;
}

export const changeType = async (id) => {
    const req = await fetch(`${BASE_URL}/task/change/${id}`, {
        method: "PATCH",
        headers
    });

    const res = await req.json();

    return res;
}

export const destroyTask = async (id) => {
    const req = await fetch(`${BASE_URL}/task/${id}`, {
        method: "DELETE",
        headers
    });

    const res = await req.json();

    return res;
}


