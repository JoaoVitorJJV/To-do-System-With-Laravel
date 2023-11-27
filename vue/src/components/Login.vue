<template>
    <main>
        <div class="container" id="container" :class="{ 'right-panel-active': isRightPanelActive }">
            <div class="form-container sign-up-container">
                <div class="inputs">
                    <div v-if="isError" class="error-container">
                        <span>{{ errorMessage }}</span>
                    </div>
                    <h1>Crie sua Conta!</h1>
                    <input type="text" v-model="registerName" placeholder="Nome" />
                    <input type="email" v-model="registerEmail" placeholder="E-mail" />
                    <input type="password" v-model="registerPassword" placeholder="Senha" />
                    <button @click="handleRegister">Cadastrar</button>
                </div>
            </div>
            <div class="form-container sign-in-container">
                <div class="inputs">
                    <div v-if="isError" class="error-container">
                        <span>{{ errorMessage }}</span>
                    </div>
                    <h1>Entrar</h1>
                    <input type="email" v-model="loginEmail" placeholder="E-mail" />
                    <input type="password" v-model="loginPassword" placeholder="Senha" />
                    <button @click="handleLogin">Entrar</button>
                </div>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Já tem conta?</h1>
                        <p>Para acessar sua lista de tarefas, forneça seu email e senha</p>
                        <button class="ghost" id="signIn" @click="swithType">Entrar</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Não tem conta?</h1>
                        <p>Cadastre-se para ter acesso a sua nova lista de tarefas</p>
                        <button class="ghost" id="signUp" @click="swithType">Me Cadastrar</button>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <p>
                Criado com ❤️ por
                <a target="_blank" href="https://github.com/JoaoVitorJJV">João Vitor</a>
            </p>
        </footer>
    </main>
</template>


<script>
import { login, register } from "../api/api.js";

export default {
    name: 'LoginComponent',
    data() {
        return {
            isRightPanelActive: false,
            loginEmail: '',
            loginPassword: '',
            registerEmail: '',
            registerPassword: '',
            registerName: '',
            isError: false,
            errorMessage: ""
        }
    },
    methods: {
        swithType() {
            // Change the type (finished or not finished in the task)
            this.isRightPanelActive = !this.isRightPanelActive
        },
        async handleLogin() {
            const res = await login(this.loginEmail, this.loginPassword);
            if (this.loginEmail && this.loginPassword) {
                if (res.error) {
                    this.isError = true;
                    this.errorMessage = "E-mail ou senha incorretos, tente novamente."
                } else {
                    // Create session and redirect user
                    localStorage.setItem("user", JSON.stringify(res.user));
                    this.$router.push('/home');
                }
            } else {
                this.isError = true;
                this.errorMessage = "Preencha todos os campos."
            }

        },
        async handleRegister() {
            const res = await register(this.registerEmail, this.registerName, this.registerPassword);

            // Checks the request for errors
            if (Object.prototype.hasOwnProperty.call(res, "errors")) {
                this.isError = true;
                this.errorMessage = res.message;
            } else {
                 // Create session and redirect user
                localStorage.setItem("user", JSON.stringify(res.user));
                this.$router.push('/home');
            }
        }
    }
}
</script>

<style scoped>
main {
    background: #f6f5f7;
    display: flex;
    width: 100%;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    font-family: 'Montserrat', sans-serif;
    height: 100vh;
    margin: -20px 0 50px;
}

h1 {
    font-weight: bold;
    margin: 0;
}

h2 {
    text-align: center;
}

p {
    font-size: 14px;
    font-weight: 100;
    line-height: 20px;
    letter-spacing: 0.5px;
    margin: 20px 0 30px;
}

span {
    font-size: 12px;
}

a {
    color: #333;
    font-size: 14px;
    text-decoration: none;
    margin: 15px 0;
}

button {
    border-radius: 20px;
    border: 1px solid #feca57;
    background-color: #feca57;
    color: #FFFFFF;
    font-size: 12px;
    font-weight: bold;
    padding: 12px 45px;
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: transform 80ms ease-in;
    cursor: pointer;
}

button:active {
    transform: scale(0.95);
}

button:focus {
    outline: none;
}

button.ghost {
    background-color: transparent;
    border-color: #FFFFFF;
}

.error-container span {
    color: #d32a2a;
}

.error-container {
    margin-bottom: 40px;
}

.inputs {
    background-color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 50px;
    height: 100%;
    text-align: center;
}

input {
    background-color: #eee;
    border: none;
    padding: 12px 15px;
    margin: 8px 0;
    width: 100%;
}

.container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
        0 10px 10px rgba(0, 0, 0, 0.22);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
}

.form-container {
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-in-container {
    left: 0;
    width: 50%;
    z-index: 2;
}

.container.right-panel-active .sign-in-container {
    transform: translateX(100%);
}

.sign-up-container {
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}

.container.right-panel-active .sign-up-container {
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: show 0.6s;
}

@keyframes show {

    0%,
    49.99% {
        opacity: 0;
        z-index: 1;
    }

    50%,
    100% {
        opacity: 1;
        z-index: 5;
    }
}

.overlay-container {
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: transform 0.6s ease-in-out;
    z-index: 100;
}

.container.right-panel-active .overlay-container {
    transform: translateX(-100%);
}

.overlay {
    background: #feca57;
    background: -webkit-linear-gradient(to right, #feca57, #feca57);
    background: linear-gradient(to right, #feca57, #feca57);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: 0 0;
    color: #FFFFFF;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: transform 0.6s ease-in-out;
}

.container.right-panel-active .overlay {
    transform: translateX(50%);
}

.overlay-panel {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    text-align: center;
    top: 0;
    height: 100%;
    width: 50%;
    transform: translateX(0);
    transition: transform 0.6s ease-in-out;
}

.overlay-left {
    transform: translateX(-20%);
}

.container.right-panel-active .overlay-left {
    transform: translateX(0);
}

.overlay-right {
    right: 0;
    transform: translateX(0);
}

.container.right-panel-active .overlay-right {
    transform: translateX(20%);
}

.social-container {
    margin: 20px 0;
}

.social-container a {
    border: 1px solid #DDDDDD;
    border-radius: 50%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin: 0 5px;
    height: 40px;
    width: 40px;
}

footer {
    background-color: #222;
    color: #fff;
    font-size: 14px;
    bottom: 0;
    position: fixed;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 999;
}

footer p {
    margin: 10px 0;
}

footer i {
    color: red;
}

footer a {
    color: #3c97bf;
    text-decoration: none;
}
</style>
