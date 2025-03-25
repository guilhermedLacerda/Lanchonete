<?php

namespace App\Livewire\Cliente;

use App\Models\Cliente;
use Livewire\Component;

class Create extends Component
{
    public $nome;
    public $endereco;
    public $telefone;
    public $cpf;
    public $email;
    public $senha;

    protected $rules = [
        'nome' => 'required|string|min:3|max:100',
        'endereco' => 'required|string|max:255',
        'telefone' => 'required|regex:/^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/',
        'cpf' => 'required|unique:clientes,cpf',
        'email' => 'required|email',
        'senha' => 'required|min:6',
    ];

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

    public function render()
    {
        return view('livewire.cliente.create');
    }

    public function store()
    {
        // Validação
        $this->validate();

        // Criptografando a senha antes de salvar
        $senhaCriptografada = bcrypt($this->senha);

        // Criando o cliente
        Cliente::create([
            'nome' => $this->nome,
            'endereco' => $this->endereco,
            'telefone' => $this->telefone,
            'cpf' => $this->cpf,
            'email' => $this->email,
            'senha' => $senhaCriptografada
        ]);

        // Flash de sucesso
        session()->flash('success', 'Cadastro realizado com sucesso!');

        // Redirecionando ou limpando os dados do formulário
        $this->reset();
    }
}