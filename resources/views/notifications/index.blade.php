<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications – Wazaaf</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f0f2f8; font-family: 'Segoe UI', system-ui, sans-serif; color: #1a1a2e; }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: #fff;
            border-bottom: 1px solid #e5e9f0;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            padding: 0 32px;
        }
        .navbar-brand-custom {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 20px;
            font-weight: 700;
            color: #1a56db;
            text-decoration: none;
        }
        .navbar-brand-custom .brand-icon {
            background: #1a56db;
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }
        .nav-links { display: flex; align-items: center; gap: 4px; margin: 0 auto; }
        .nav-links a {
            font-size: 14px;
            color: #6b7280;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.15s;
            border-bottom: 2px solid transparent;
        }
        .nav-links a:hover { color: #1a1a2e; }
        .nav-links a.active { color: #1a56db; border-bottom: 2px solid #1a56db; border-radius: 0; }
        .navbar-right { display: flex; align-items: center; gap: 16px; margin-left: auto; }
        .notif-btn {
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            color: #6b7280;
            font-size: 18px;
            padding: 4px;
            text-decoration: none;
        }
        .notif-badge {
            position: absolute;
            top: -2px;
            right: -4px;
            background: #1a56db;
            color: #fff;
            font-size: 10px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }
        .user-menu {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 8px;
            transition: background 0.15s;
        }
        .user-menu:hover { background: #f5f7fb; }
        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #d1d5db;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .user-name { font-size: 14px; font-weight: 500; color: #1a1a2e; }
        .btn-logout-nav {
            background: none;
            border: none;
            color: #6b7280;
            font-size: 13px;
            cursor: pointer;
            padding: 4px 8px;
        }
        .btn-logout-nav:hover { color: #ef4444; }

        /* ===== PAGE ===== */
        .page-wrapper { max-width: 760px; margin: 0 auto; padding: 32px 24px; }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .page-title { font-size: 22px; font-weight: 700; color: #0f172a; }
        .btn-mark-all {
            background: #f0f2f8;
            color: #1a56db;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.15s;
        }
        .btn-mark-all:hover { background: #dbeafe; }

        /* ===== NOTIFICATION CARD ===== */
        .notif-card {
            background: #fff;
            border: 1px solid #e5e9f0;
            border-radius: 12px;
            padding: 18px 20px;
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            transition: all 0.15s;
        }
        .notif-card.unread {
            border-left: 4px solid #1a56db;
            background: #f8faff;
        }
        .notif-card:hover { box-shadow: 0 2px 12px rgba(26,86,219,0.07); }

        .notif-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: #dbeafe;
            color: #1a56db;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        .notif-icon.read { background: #f3f4f6; color: #9ca3af; }

        .notif-body { flex: 1; }
        .notif-title { font-size: 14px; font-weight: 600; color: #0f172a; margin-bottom: 4px; }
        .notif-meta { font-size: 13px; color: #6b7280; margin-bottom: 6px; }
        .notif-time { font-size: 12px; color: #9ca3af; }

        .notif-actions { display: flex; align-items: center; gap: 8px; flex-shrink: 0; }
        .btn-view {
            background: #1a56db;
            color: #fff;
            border: none;
            padding: 6px 14px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.15s;
        }
        .btn-view:hover { background: #1447b8; color: #fff; }
        .btn-read {
            background: transparent;
            color: #9ca3af;
            border: 1px solid #e5e9f0;
            padding: 6px 10px;
            border-radius: 7px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.15s;
        }
        .btn-read:hover { border-color: #1a56db; color: #1a56db; }

        /* ===== EMPTY ===== */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #9ca3af;
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e5e9f0;
        }
        .empty-state i { font-size: 48px; opacity: 0.3; margin-bottom: 12px; display: block; }
        .empty-state p { font-size: 15px; }
    </style>
</head>
<body>

{{-- ===== NAVBAR ===== --}}
<nav class="navbar-custom">
    <a class="navbar-brand-custom" href="{{ route('home') }}">
        <div class="brand-icon"><i class="fas fa-briefcase"></i></div>
        Wazaaf
    </a>

    <div class="nav-links">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('jobs.index') }}" class="{{ request()->routeIs('jobs.*') ? 'active' : '' }}">Jobs</a>
        <a href="{{ route('applications.index') }}" class="{{ request()->routeIs('applications.*') ? 'active' : '' }}">My Applications</a>
        <a href="{{ route('notifications.index') }}" class="{{ request()->routeIs('notifications.*') ? 'active' : '' }}">Notifications</a>
    </div>

    <div class="navbar-right">
        <a href="{{ route('notifications.index') }}" class="notif-btn">
            <i class="fas fa-bell"></i>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="notif-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
            @endif
        </a>
        <div class="user-menu">
            <div class="user-avatar">
                <i class="fas fa-user" style="color:#9ca3af;font-size:16px;"></i>
            </div>
            <span class="user-name">{{ Auth::user()->name ?? 'User' }}</span>
            <i class="fas fa-chevron-down" style="font-size:11px;color:#9ca3af;"></i>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout-nav"><i class="fas fa-sign-out-alt"></i></button>
        </form>
    </div>
</nav>

{{-- ===== CONTENT ===== --}}
<div class="page-wrapper">

    <div class="page-header">
        <h1 class="page-title">
            Notifications
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span style="font-size:14px;color:#1a56db;font-weight:500;margin-left:8px;">
                    {{ auth()->user()->unreadNotifications->count() }} unread
                </span>
            @endif
        </h1>

        @if(auth()->user()->unreadNotifications->count() > 0)
            <form action="{{ route('notifications.readAll') }}" method="POST">
                @csrf
                <button type="submit" class="btn-mark-all">
                    <i class="fas fa-check-double" style="margin-right:6px;"></i>Mark all as read
                </button>
            </form>
        @endif
    </div>

    @if($notifications->count())
        @foreach($notifications as $notif)
            @php $data = $notif->data; @endphp
            <div class="notif-card {{ is_null($notif->read_at) ? 'unread' : '' }}">

                <div class="notif-icon {{ !is_null($notif->read_at) ? 'read' : '' }}">
                    <i class="fas fa-briefcase"></i>
                </div>

                <div class="notif-body">
                    <div class="notif-title">New job: {{ $data['job_title'] ?? 'Job Opportunity' }}</div>
                    <div class="notif-meta">
                        <i class="fas fa-map-marker-alt" style="font-size:11px;margin-right:4px;"></i>{{ $data['location'] ?? '' }}
                        &nbsp;·&nbsp;
                        <span style="text-transform:capitalize;">{{ str_replace('_', ' ', $data['job_type'] ?? '') }}</span>
                    </div>
                    <div class="notif-time">{{ $notif->created_at->diffForHumans() }}</div>
                </div>

                <div class="notif-actions">
                    @if(isset($data['job_id']))
                        <a href="{{ route('jobs.show', $data['job_id']) }}" class="btn-view">View Job</a>
                    @endif
                    @if(is_null($notif->read_at))
                        <form action="{{ route('notifications.read', $notif->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-read">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach

        <div style="margin-top:20px;">
            {{ $notifications->links('pagination::simple-bootstrap-4') }}
        </div>

    @else
        <div class="empty-state">
            <i class="fas fa-bell-slash"></i>
            <p>No notifications yet.</p>
        </div>
    @endif

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>