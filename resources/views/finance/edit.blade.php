<x-app-layout>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
      
        }

        .container {
            text-align: center;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        form {
            width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
        }

        button {
            background-color: #3498db;
            color: #0a35c4;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>

    <div class="container mx-auto my-8">
        <h1>Edit Finance Record</h1>
        <form action="{{ route('finance.update', $finance->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="amount">Amount:</label>
                <input type="number" step="0.01" name="amount" id="amount" value="{{ $finance->amount }}" required>
                @error('amount')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</x-app-layout>
