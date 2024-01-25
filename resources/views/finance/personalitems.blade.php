<x-app-layout>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;


        }

        .container {
            width: 80%;
        }

        h2 {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        form {
            border: 1px solid #ccc;
            padding: 1rem;
            border-radius: 0.25rem;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
        }

        select,
        input {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
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
    </style>

    <div class="container mx-auto">
        <h2>Your Contributions</h2>
        <div class="flex justify-center">
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
                </thead>
                <tbody>
                @forelse($finances as $finance)
                <tr>
                    <td>{{ $finance->user->name }}</td>
                    <td>{{ $finance->amount }}</td>
                    <td>{{ $finance->created_at }}</td>
                    <td>{{ $finance->updated_at }}</td>
                    
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-4 text-center">No contributions found.</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4 text-center">

        <p>
            @php
            $totalContributions = auth()->user()->finances->sum('amount');
            @endphp
            <strong>Total Amount: {{ $totalContributions }}</strong>
        </p>
    </div>


</x-app-layout>
