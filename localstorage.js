// localstorage.js

// Função para salvar dados no localStorage
function saveUserData(id, username, balance) {
    localStorage.setItem('userId', id);
    localStorage.setItem('username', username);
    localStorage.setItem('balance', balance);
}

// Função para carregar dados do localStorage
function loadUserData() {
    return {
        id: localStorage.getItem('userId') || 'Não disponível',
        username: localStorage.getItem('username') || 'Não disponível',
        balance: localStorage.getItem('balance') || '0.00'
    };
}
