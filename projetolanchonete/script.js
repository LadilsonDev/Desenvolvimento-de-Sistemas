document.addEventListener('DOMContentLoaded', () => {
    const formFuncionario = document.getElementById('form-funcionario');
    const formPedido = document.getElementById('form-pedido');
    const listaFuncionarios = document.getElementById('lista-funcionarios');
    const listaPedidos = document.getElementById('lista-pedidos');
    const selectResponsavel = document.getElementById('responsavel');

    // Carregar dados de funcionários e pedidos
    carregarFuncionarios();
    carregarPedidos();

    // Função para cadastrar funcionário
    formFuncionario.addEventListener('submit', (e) => {
        e.preventDefault();
        const nome = document.getElementById('nome-funcionario').value;
        const cpf = document.getElementById('cpf-funcionario').value;

        if (cpf.length !== 11) {
            alert('O CPF deve ter 11 dígitos.');
            return;
        }

        const formData = new FormData();
        formData.append('nome', nome);
        formData.append('cpf', cpf);

        fetch('funcionarios.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            carregarFuncionarios();
            formFuncionario.reset();
        });
    });

    // Função para cadastrar pedido
    formPedido.addEventListener('submit', (e) => {
        e.preventDefault();
        const nomePedido = document.getElementById('nome-pedido').value;
        const descricaoPedido = document.getElementById('descricao-pedido').value;
        const responsavelId = document.getElementById('responsavel').value;
        const status = document.getElementById('status-pedido').value;

        const formData = new FormData();
        formData.append('nome_pedido', nomePedido);
        formData.append('descricao', descricaoPedido);
        formData.append('responsavel_id', responsavelId);
        formData.append('status', status);

        fetch('pedidos.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            carregarPedidos();
            formPedido.reset();
        });
    });

    // Função para carregar funcionários
    function carregarFuncionarios() {
        fetch('funcionarios.php')
        .then(response => response.json())
        .then(funcionarios => {
            listaFuncionarios.innerHTML = '';
            selectResponsavel.innerHTML = '';
            funcionarios.forEach(func => {
                const li = document.createElement('li');
                li.textContent = `${func.nome} - CPF: ${func.cpf}`;
                listaFuncionarios.appendChild(li);

                const option = document.createElement('option');
                option.value = func.id;
                option.textContent = func.nome;
                selectResponsavel.appendChild(option);
            });
        });
    }

    // Função para carregar pedidos
    function carregarPedidos() {
        fetch('pedidos.php')
        .then(response => response.json())
        .then(pedidos => {
            listaPedidos.innerHTML = '';
            pedidos.forEach(pedido => {
                const li = document.createElement('li');
                li.textContent = `${pedido.nome_pedido} - Responsável: ${pedido.responsavel ? pedido.responsavel : 'Desconhecido'} - Status: ${pedido.status}`;
                li.addEventListener('click', () => atualizarStatus(pedido.id));
                listaPedidos.appendChild(li);
            });
        });
    }

    // Função para atualizar o status do pedido
    function atualizarStatus(id) {
        const novoStatus = prompt('Digite o novo status (A Fazer, Fazendo, Pronto para entrega):');
        if (!novoStatus || !['A Fazer', 'Fazendo', 'Pronto para entrega'].includes(novoStatus)) {
            alert('Status inválido!');
            return;
        }

        fetch('pedidos.php', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${id}&status=${novoStatus}`
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            carregarPedidos();
        });
    }
});
