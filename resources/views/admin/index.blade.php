<x-app-layout>
    @section('title', 'Tabela de Orçamento')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="h2">Dados pessoais</p>

                    <div class="container">
                        <table class="table table-success">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Rua</th>
                                    <th>Número</th>
                                    <th>Bairro</th>
                                    <th>CEP</th>
                                    <th>Complemento</th>
                                    <th>Município</th>
                                    <th>UF</th>
                                    <th>País</th>
                                    <th>Ações</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_users as $user)
                                <tr>
                                    <td>{{ $user['id'] }}</td>
                                    <td>{{ $user['user_project_budget']['name'] }}</td>
                                    <td>{{ $user['user_project_budget']['email'] }}</td>
                                    <td>{{ $user['user_project_budget']['telefone'] }}</td>
                                    <td>{{ $user['user_project_budget']['rua'] }}</td>
                                    <td>{{ $user['user_project_budget']['numero'] }}</td>
                                    <td>{{ $user['user_project_budget']['bairro'] }}</td>
                                    <td>{{ $user['user_project_budget']['cep'] }}</td>
                                    <td>{{ $user['user_project_budget']['complemento'] ?? '' }}</td>
                                    <td>{{ $user['user_project_budget']['municipio'] }}</td>
                                    <td>{{ $user['user_project_budget']['uf'] }}</td>
                                    <td>{{ $user['user_project_budget']['pais'] }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info">
                                            <a href="{{ route('admin.show', $user['id']) }}">Visão completa</a>

                                        </button>

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>