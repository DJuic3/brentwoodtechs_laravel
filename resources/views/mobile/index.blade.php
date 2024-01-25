<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between items-center">
        </h2>
    </x-slot>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin: 25px;
        }

        #searchInput {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px;
        }

        #searchButton {
            background-color: #3498db;
            color: #fff;
            font-weight: bold;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        table {
            border: 1px solid #ccc;
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        thead {
            background-color: #f5f5f5;
        }
    </style>

    <div class="search-container">
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for names..." size="30">
        <button id="searchButton" onclick="searchTable()">Search</button>
    </div>

    @if ($users->isEmpty())
    <p>No Employee Found.</p>
    @else
    <div style="display: grid; justify-content: center;">
        <table>
            <thead>
            <tr>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Email Address</th>
                <th>Department</th>
                <th>Employment Status</th>
                <th>Phone Number</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->dob }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->department }}</td>
                <td>{{ $user->status }}</td>
                <td>{{ $user->phonenumber }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif

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
