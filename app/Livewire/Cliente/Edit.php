<?php

namespace App\Livewire\Cliente;

use App\Models\Cliente;
use Livewire\Component;

class Edit extends Component
{
    public $clienteId;
    public $nome;
    public $endereco;
    public $telefone;
    public $cpf;
    public $email;
    public $senha;

    // A definição das regras de validação deve ser feita de forma condicional
    public function rules()
    {
        return [
            'nome' => 'required|string|min:3|max:100',
            'endereco' => 'required|string|max:255',
            'telefone' => 'required|regex:/^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/',
            'cpf' => 'required|unique:clientes,cpf,' . $this->clienteId,  // Validação do CPF, ignorando o cliente atual
            'email' => 'required|email',
            'senha' => 'required|min:6',
        ];
    }

    protected $messages = [
        'nome.required' => 'Nome é obrigatório.',
        'nome.string' => 'Nome deve ser um texto.',
        'nome.min' => 'Nome deve ter no mínimo 3 caracteres.',
        'nome.max' => 'Nome deve ter no máximo 100 caracteres.',
        'endereco.required' => 'Endereço é obrigatório.',
        'endereco.string' => 'Endereço deve ser um texto.',
        'endereco.max' => 'Endereço deve ter no máximo 255 caracteres.',
        'telefone.required' => 'Telefone é obrigatório.',
        'telefone.regex' => 'Formato de telefone inválido.',
        'cpf.required' => 'CPF é obrigatório.',
        'cpf.unique' => 'Este CPF já está cadastrado.',
        'email.required' => 'E-mail é obrigatório.',
        'email.email' => 'Formato de e-mail inválido.',
        'senha.required' => 'Senha é obrigatória.',
        'senha.min'=> 'Senha deve conter no mínimo 6 caracteres.',
    ];

    protected $listeners = [
        'editarCliente',
        'closeEditModal' => 'fecharModal'
    ];

    // Método para fechar o modal
    public function fecharModal()
    {
        $this->dispatch('hideModal');
    }

    public function render()
    {
        return view('livewire.cliente.edit');
    }

    // Carregar dados do cliente no componente
    public function mount($id)
    {
        $cliente = Cliente::find($id);

        if ($cliente) {
            $this->clienteId = $cliente->id;
            $this->nome = $cliente->nome;
            $this->endereco = $cliente->endereco;
            $this->telefone = $cliente->telefone;
            $this->cpf = $cliente->cpf;
            $this->email = $cliente->email;
            $this->senha = $cliente->senha;
        }
    }

    // Método para salvar a edição do cliente
    public function salvar()
    {
        $this->validate();  // Validar conforme as regras definidas

        // Atualizar dados do cliente
        $cliente = Cliente::find($this->clienteId);
        $cliente->nome = $this->nome;
        $cliente->endereco = $this->endereco;
        $cliente->telefone = $this->telefone;
        $cliente->cpf = $this->cpf;
        $cliente->email = $this->email;
        $cliente->senha = $this->senha;

        // Salvar no banco de dados
        $cliente->save();

        // Exibir mensagem de sucesso
        session()->flash('success', 'Cliente Atualizado');
    }
}
