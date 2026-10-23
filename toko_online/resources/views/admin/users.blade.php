<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Role User</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f6f8fd 0%, #f1f4f9 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 50px 20px;
            color: #1e293b;
        }
        .dashboard-card {
            width: 100%;
            max-width: 950px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            border: 1px solid #e2e8f0;
            overflow: hidden;
            animation: slideUp 0.4s ease-out;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card-header {
            padding: 24px 32px;
            border-bottom: 1px solid #e2e8f0;
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #0f172a;
            letter-spacing: -0.02em;
        }
        .btn-back {
            font-size: 0.875rem;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 8px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }
        .btn-back:hover {
            background-color: #f1f5f9;
            color: #0f172a;
            border-color: #cbd5e1;
        }
        .card-body {
            padding: 32px;
        }
        .alert {
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success {
            background-color: #ecfdf5;
            border: 1px solid #10b981;
            color: #065f46;
        }
        .alert-error {
            background-color: #fef2f2;
            border: 1px solid #ef4444;
            color: #991b1b;
        }
        .table-container {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        th {
            background-color: #f8fafc;
            padding: 16px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            border-bottom: 1px solid #e2e8f0;
        }
        td {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.875rem;
            color: #334155;
            vertical-align: middle;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:hover td {
            background-color: #f8fafc;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
            letter-spacing: 0.02em;
        }
        .badge-admin {
            background-color: #ffe4e6;
            color: #be123c;
            border: 1px solid #fda4af;
        }
        .badge-staff {
            background-color: #e0e7ff;
            color: #4338ca;
            border: 1px solid #a5b4fc;
        }
        .badge-customer {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }
        .action-form {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .custom-select {
            appearance: none;
            -webkit-appearance: none;
            padding: 8px 36px 8px 12px;
            font-size: 0.875rem;
            font-family: inherit;
            color: #1e293b;
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            cursor: pointer;
            outline: none;
            transition: all 0.2s ease;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
        }
        .custom-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        .btn-save {
            padding: 8px 16px;
            font-size: 0.875rem;
            font-weight: 500;
            font-family: inherit;
            color: #ffffff;
            background: linear-gradient(to right, #4f46e5, #6366f1);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(99, 102, 241, 0.3);
        }
        .btn-save:hover {
            background: linear-gradient(to right, #4338ca, #4f46e5);
            box-shadow: 0 4px 6px rgba(99, 102, 241, 0.4);
            transform: translateY(-1px);
        }
        .btn-save:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <div class="dashboard-card">
        <div class="card-header">
            <h2>Manajemen Role Pengguna</h2>
            <a href="/barang" class="btn-back">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        <div class="card-body">
            
            @if (session('status'))
                <div class="alert alert-success">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Role Saat Ini</th>
                            <th>Aksi Pengubahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $u)
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #0f172a;">{{ $u->username }}</div>
                            </td>
                            <td>{{ $u->nama_lengkap }}</td>
                            <td>
                                @if($u->role == 'admin')
                                    <span class="badge badge-admin">Admin</span>
                                @elseif($u->role == 'staff')
                                    <span class="badge badge-staff">Staff</span>
                                @else
                                    <span class="badge badge-customer">Customer</span>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.users.role.update', $u->id_user) }}" class="action-form">
                                    @csrf
                                    @method('PATCH')
                                    
                                    <select name="role" class="custom-select">
                                        <option value="customer" {{ $u->role == 'customer' ? 'selected' : '' }}>Customer</option>
                                        <option value="staff" {{ $u->role == 'staff' ? 'selected' : '' }}>Staff</option>
                                        <option value="admin" {{ $u->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    <button type="submit" class="btn-save">Simpan</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>