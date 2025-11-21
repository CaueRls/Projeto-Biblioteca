<main class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8 space-y-6">
        
        <div>
            {{-- Título Original --}}
            <h2 class="text-center text-3xl font-extrabold text-gray-900">
                Crie sua Conta
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                É rápido e fácil.
            </p>
        </div>

        {{-- ADICIONEI AQUI: action para a rota e o method POST --}}
        <form class="space-y-6" action="{{ route('register.submit') }}" method="POST">
            
            {{-- ADICIONEI AQUI: O Token de segurança obrigatório --}}
            @csrf

            <div>
                <label for="full-name" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                {{-- ADICIONEI: name="name" e value="{{ old('name') }}" --}}
                <input id="full-name" name="name" type="text" required 
                    value="{{ old('name') }}"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                
                @error('name')
                    <span style="color: red; font-size: 0.8rem;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="email-address" class="block text-sm font-medium text-gray-700">E-mail</label>
                {{-- ADICIONEI: name="email" --}}
                <input id="email-address" name="email" type="email" autocomplete="email" required 
                    value="{{ old('email') }}"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                
                @error('email')
                    <span style="color: red; font-size: 0.8rem;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                {{-- ADICIONEI: name="password" --}}
                <input id="password" name="password" type="password" autocomplete="new-password" required 
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                
                @error('password')
                    <span style="color: red; font-size: 0.8rem;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password-confirm" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                {{-- ADICIONEI: name="password_confirmation" --}}
                <input id="password-confirm" name="password_confirmation" type="password" required 
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                    Cadastrar
                </button>
            </div>
        </form>

        <div class="text-center">
            <p class="text-sm text-gray-600">
                Já tem uma conta?
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 hover:underline">
                    Faça login
                </a>
            </p>
        </div>
    </div>
</main>