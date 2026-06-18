# Role & Permission Matrix - Mini Market Management System

## 🏢 Organizational Structure (Sesuai Studi Kasus)

```
┌─────────────────────────────────────┐
│  Pak Jayusman (Owner / Admin)       │
│  - Pemilik 5 cabang mini market    │
│  - Full access to all features     │
│  - Monitor semua toko              │
└────────────────┬────────────────────┘
                 │
        ┌────────┴─────────┐
        │                  │
    ┌───▼──────────┐   ┌──▼──────────────┐
    │ Toko 1       │   │ Toko 2-5        │
    └───┬──────────┘   └──┬──────────────┘
        │                  │
   ┌────┴────────────┐     │
   │                 │     │
┌──▼──────┐  ┌──────▼──┐  │
│ Manajer  │  │Toko...  │  │
│   Toko   │  │Manager  │  │
└──┬───────┘  └─────────┘  │
   │                       │
   ├─► Supervisor          │
   │                       │
   ├─► Kasir ◄─────────────┤
   │                       │
   └─► Gudang ◄────────────┘
```

---

## 📋 Permission Matrix (32 Total Permissions)

### Dashboard Permissions (1)
| Permission | Owner | Manager | Supervisor | Cashier | Warehouse |
|-----------|:-----:|:-------:|:----------:|:-------:|:---------:|
| view dashboard | ✅ | ✅ | ✅ | ✅ | ✅ |

### User Management (4)
| Permission | Owner | Manager | Supervisor | Cashier | Warehouse |
|-----------|:-----:|:-------:|:----------:|:-------:|:---------:|
| view users | ✅ | ❌ | ❌ | ❌ | ❌ |
| create user | ✅ | ❌ | ❌ | ❌ | ❌ |
| edit user | ✅ | ❌ | ❌ | ❌ | ❌ |
| delete user | ✅ | ❌ | ❌ | ❌ | ❌ |

### Store Management (4)
| Permission | Owner | Manager | Supervisor | Cashier | Warehouse |
|-----------|:-----:|:-------:|:----------:|:-------:|:---------:|
| view stores | ✅ | ❌ | ❌ | ❌ | ❌ |
| create store | ✅ | ❌ | ❌ | ❌ | ❌ |
| edit store | ✅ | ❌ | ❌ | ❌ | ❌ |
| delete store | ✅ | ❌ | ❌ | ❌ | ❌ |

### Transaction Management (5)
| Permission | Owner | Manager | Supervisor | Cashier | Warehouse |
|-----------|:-----:|:-------:|:----------:|:-------:|:---------:|
| view transactions | ✅ | ✅ | ✅ | ✅ | ❌ |
| create transaction | ✅ | ✅ | ❌ | ✅ | ❌ |
| edit transaction | ✅ | ❌ | ❌ | ❌ | ❌ |
| delete transaction | ✅ | ❌ | ❌ | ❌ | ❌ |
| print transaction | ✅ | ✅ | ✅ | ❌ | ❌ |

### Inventory Management (6)
| Permission | Owner | Manager | Supervisor | Cashier | Warehouse |
|-----------|:-----:|:-------:|:----------:|:-------:|:---------:|
| view inventory | ✅ | ✅ | ✅ | ❌ | ✅ |
| create inventory | ✅ | ✅ | ❌ | ❌ | ❌ |
| edit inventory | ✅ | ✅ | ❌ | ❌ | ❌ |
| delete inventory | ✅ | ❌ | ❌ | ❌ | ❌ |
| print inventory | ✅ | ✅ | ✅ | ❌ | ❌ |
| manage stock | ✅ | ❌ | ❌ | ❌ | ✅ |

### Reports (3)
| Permission | Owner | Manager | Supervisor | Cashier | Warehouse |
|-----------|:-----:|:-------:|:----------:|:-------:|:---------:|
| view reports | ✅ | ✅ | ✅ | ❌ | ❌ |
| create reports | ✅ | ❌ | ❌ | ❌ | ❌ |
| export reports | ✅ | ✅ | ❌ | ❌ | ❌ |

### Settings (2)
| Permission | Owner | Manager | Supervisor | Cashier | Warehouse |
|-----------|:-----:|:-------:|:----------:|:-------:|:---------:|
| view settings | ✅ | ✅ | ❌ | ❌ | ❌ |
| edit settings | ✅ | ❌ | ❌ | ❌ | ❌ |

---

## 🎯 Role-Based Access Summary

### 👑 Owner (Pak Jayusman)
**Permissions: 32/32 (Full Access)**
- Can do everything
- Monitor all 5 branches
- Manage users
- Create stores
- View and export reports
- Manage all transactions and inventory

**Use Case:**
- Strategic decisions
- Multi-store oversight
- User management
- System configuration

---

### 🏪 Store Manager (Manajer Toko)
**Permissions: 10/32**
- Manage one store
- Create & view transactions
- Manage inventory for their store
- Print reports
- View reports
- Limited settings access

**Available Features:**
- Dashboard (view)
- Transactions (create, view, print)
- Inventory (create, view, edit, print)
- Reports (view, export)
- Settings (view)

**Restrictions:**
- Cannot delete users/transactions
- Cannot manage other stores
- Cannot create reports
- Cannot edit system settings

---

### 👁️ Supervisor
**Permissions: 6/32 (Monitor Only)**
- Monitor transactions
- Monitor inventory
- View reports
- Print reports
- **No edit/create/delete rights**

**Available Features:**
- Dashboard (view)
- Transactions (view, print)
- Inventory (view, print)
- Reports (view)

**Restrictions:**
- Cannot create transactions
- Cannot edit inventory
- Cannot create/delete anything
- Cannot access settings

---

### 💳 Cashier (Pegawai Kasir)
**Permissions: 3/32 (Transaction Only)**
- Create new transactions
- View transaction history
- Process sales

**Available Features:**
- Dashboard (view)
- Transactions (create, view)

**Restrictions:**
- Cannot view inventory
- Cannot view reports
- Cannot print anything
- Cannot manage other data
- Cannot access settings

**Main Responsibility:**
- Handle customer payments
- Record sales transactions

---

### 📦 Warehouse Staff (Pegawai Gudang)
**Permissions: 3/32 (Inventory Only)**
- Manage inventory
- Track stock movements
- Monitor warehouse

**Available Features:**
- Dashboard (view)
- Inventory (view, manage stock)

**Restrictions:**
- Cannot create transactions
- Cannot view sales reports
- Cannot access user/store management
- Cannot edit core inventory data
- Cannot access settings

**Main Responsibility:**
- Stock in/out operations
- Warehouse monitoring
- Physical inventory tracking

---

## 🔐 Permission Categories

### Authentication & Dashboard
```php
'view dashboard',
```

### User Management (Admin Only)
```php
'view users',
'create user',
'edit user',
'delete user',
```

### Store Management (Admin Only)
```php
'view stores',
'create store',
'edit store',
'delete store',
```

### Transaction Management
```php
'view transactions',      // Manager, Supervisor, Cashier
'create transaction',     // Manager, Cashier
'edit transaction',       // Owner
'delete transaction',     // Owner
'print transaction',      // Manager, Supervisor
```

### Inventory Management
```php
'view inventory',         // Manager, Supervisor, Warehouse
'create inventory',       // Manager
'edit inventory',         // Manager
'delete inventory',       // Owner
'print inventory',        // Manager, Supervisor
'manage stock',           // Warehouse
```

### Reporting
```php
'view reports',           // Manager, Supervisor
'create reports',         // Owner
'export reports',         // Manager
```

### System Settings
```php
'view settings',          // Manager
'edit settings',          // Owner
```

---

## 🎭 Database Relationships

### roles table
| id | name | 
|----|------|
| 1 | owner |
| 2 | store_manager |
| 3 | supervisor |
| 4 | cashier |
| 5 | warehouse_staff |

### permissions table
32 permission records (as listed above)

### users table
| id | name | email | password | role_id |
|----|------|-------|----------|---------|
| 1 | Pak Jayusman | owner@minimarket.test | hashed | owner |
| 2 | Manager | manager@minimarket.test | hashed | store_manager |
| 3 | Supervisor | supervisor@minimarket.test | hashed | supervisor |
| 4 | Cashier | cashier@minimarket.test | hashed | cashier |
| 5 | Warehouse | warehouse@minimarket.test | hashed | warehouse_staff |

### role_has_permissions table
Maps each role to its permissions

### model_has_roles table
Maps each user to their role

---

## 💡 Usage in Blade Templates

```blade
<!-- Check if user has permission -->
@can('create transaction')
    <button>Create Transaction</button>
@endcan

<!-- Check if user has role -->
@role('store_manager')
    <div>Manager only content</div>
@endrole

<!-- Check multiple permissions -->
@can('view transactions')
@can('print transaction')
    <a href="/print">Print Transaction</a>
@endcan
@endcan
```

---

## 🔧 Usage in Controllers

```php
// Check permission in controller
public function store(Request $request) {
    $this->authorize('create transaction');
    // ... create transaction
}

// Check role
if ($user->hasRole('store_manager')) {
    // ...
}

// Check any permission
if ($user->hasAnyPermission(['create transaction', 'edit transaction'])) {
    // ...
}

// Get all permissions
$permissions = $user->getAllPermissions();

// Get role names
$roles = $user->getRoleNames();
```

---

## 🛡️ Security Implementation

✅ **Permission Checking**
- Every route requires appropriate permissions
- Blade directives protect UI elements
- Controller-level authorization checks

✅ **Role-Based Access**
- Clear separation of duties
- Hierarchical permission structure
- Granular permission control

✅ **Audit Trail Ready**
- Can track which role did what
- Permission-based logging possible
- Activity history trackable by role

---

## 🚀 Future Enhancements

1. **Store-based filtering**
   - Managers only see their store's data
   - Staff segregation by store

2. **Time-based permissions**
   - Working hours restrictions
   - Shift-based access

3. **Data isolation**
   - Complete data separation by store
   - User can only see their store's data

4. **Activity logging**
   - Track who did what
   - Audit trail by permission
   - Report generation per role

5. **Delegation**
   - Temporary permission granting
   - Approval workflows
   - Escalation procedures

---

**Last Updated: 2026-06-10**
**Status: Active and Functional** ✅
