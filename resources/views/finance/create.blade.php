<x-app-layout>


    <style>
        body {
            font-family: 'Arial', sans-serif;
        
        }

        .container {
            width: 400px;
            text-align: center;
        }

        h2 {
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

        button {
            background-color: #3498db;
            color: #0c0c0c;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>

    <div class="container mx-auto">
        <h2>Create Finance Record</h2>
        <form method="POST" action="{{ route('finance.store') }}">
            @csrf
            <div>
                <label for="employee_id">Member:</label>
                <select name="employee_id" id="employee_id" required>
                    @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
                @error('employee_id')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="amount">Amount:</label>
                <input type="number" step="0.01" name="amount" id="amount" required>
                @error('amount')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Submit Contribution</button>
        </form>
    </div>
</x-app-layout>
