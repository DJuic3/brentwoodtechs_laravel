<x-app-layout>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 4rem auto;
            max-width: 800px;
        }

        a.edit-btn,
        button.delete-btn {
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        a.edit-btn {
            background-color: #3498db;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
            margin-right: 0.5rem;
        }

        button.delete-btn {
            background-color: #e74c3c;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
        }

        .button-group {
            display: flex;
            gap: 0.5rem;
        }

        .button-group a,
        .button-group form {
            flex: 1;
        }

        .success-message {
            background-color: #4caf50;
            color: #fff;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin: 1rem 0;
        }

        #searchInput {
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            padding: 0.5rem;
        }

        #searchButton {
            background-color: #3498db;
            color: #fff;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .center-container {
            text-align: center;
        }
    </style>

    <div class="search-container">
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for amount or name..." size="30">
        <button id="searchButton" onclick="searchTable()">Search</button>
    </div>

    <div class="container mx-auto my-8">
        <div class="center-container">
            <a href="{{ route('finance.create') }}" class="edit-btn">Add Contribution</a>

            @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
            @endif
        </div>

        <div class="flex justify-center">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Member ID</th>
                    <th>Amount</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($finances as $finance)
                <tr>
                    <td>{{ $finance->id }}</td>
                    <td>{{ $finance->user->name}}</td>
                    <td>{{ $finance->amount }}</td>
                    <td>{{ $finance->created_at }}</td>
                    <td>
                        <div class="button-group">
                            <a href="{{ route('finance.edit', $finance->id) }}" class="edit-btn">Edit</a>
                            <form action="{{ route('finance.destroy', $finance->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-4 text-center">No finances found.</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                if (i === 0) {
                    continue;
                }

                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");

                for (j = 0; j < td.length; j++) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break; 
                    }
                }
            }
        }
    </script>
</x-app-layout>
