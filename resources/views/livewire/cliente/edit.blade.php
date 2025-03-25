<div class="mt-5">

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mx-auto my-5 shadow-lg p-3 mb-5 bg-white rounded w-75">
        <h5 class="card-header">Editar Cliente</h5>

        <div class="card-body">
            <form wire:submit.prevent="salvar">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control border-radius: 50px; " id="nome" name="nome" placeholder="Insira seu Nome" wire:model.defer="nome">
                    @error('nome')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="endereco">Endereco</label>
                    <input type="text" name="endereco" id="endereco" class="form-control" wire:model.defer="endereco" placeholder="Insira seu endereço">
                    @error('endereco')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="telefone">Telefone</label>
                    <input class="form-control" name="telefone" id="telefone" wire:model.defer="telefone" placeholder="Insira seu telefone"></input>
                    @error('telefone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control @error('cpf') is-invalid @enderror" 
                           name="cpf" id="cpf" wire:model.defer="cpf" placeholder="Insira seu CPF">
                    
                    @error('cpf')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input class="form-control" name="email" id="email" wire:model.defer="email" placeholder="Insira seu Email"></input>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" name="senha" id="senha" wire:model.defer="senha" placeholder="Insira sua Senha"></input>
                    @error('senha')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Confirmar Edição</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('fecharModalEdicao', function() {
            var modal = document.getElementById('editModal');
            var modalInstance = bootstrap.Modal.getInstance(modal);

            if (modalInstance) {
                modalInstance.hide();
            } else {
                var newModal = new bootstrap.modal(modal);
                newModal.hide();
            }

            document.querySelectorAll('.modal-backdrop')
                .forEach(el => el.remove());
            document.body.classList.remove('modal-open');
        })
    });
</script>

</div>