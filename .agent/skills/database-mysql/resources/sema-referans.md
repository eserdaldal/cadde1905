# CADDE1905 — Veritabanı Şema Referansı

Bu dosya database-mysql skill'i tarafından referans olarak kullanılır.

## Temel Tablolar — Kolon Özeti

### users
```sql
id, name, username, email, password,
rank (enum: nev_zuhur/mektepli/mulazim/kudema),
cp_balance (int default 0),
avatar, bio, remember_token, timestamps
```

### news
```sql
id, title, slug (unique), content, excerpt,
cover_image, user_id (FK), category_id (FK),
view_count (int default 0),
published_at (nullable), timestamps, deleted_at
```

### categories
```sql
id, name, slug (unique), description,
parent_id (nullable self-ref FK), timestamps
```

### history_events
```sql
id, title, slug (unique), content, event_date (date),
cover_image, user_id (FK), published_at (nullable), timestamps
```

### legends
```sql
id, name, slug (unique), position, years_active,
bio, cover_image, user_id (FK),
published_at (nullable), timestamps
```

### efsane_moments
```sql
id, title, slug (unique), description, match_date (date),
opponent, score, cover_image, video_url (nullable),
user_id (FK), published_at (nullable), timestamps
```

### comments
```sql
id, content, user_id (FK),
commentable_id, commentable_type (polymorphic),
is_approved (bool default false), timestamps
```

### likes
```sql
id, user_id (FK),
likeable_id, likeable_type (polymorphic),
timestamps
```

### cp_transactions
```sql
id, user_id (FK), amount (int), type (enum: earn/spend),
description, timestamps
```

### collections
```sql
id, user_id (FK),
collectable_id, collectable_type (polymorphic),
timestamps
```

## İlişki Haritası

```
User → hasMany → News, Comments, Likes, CpTransactions
News → belongsTo → User (author), Category
News → hasMany → Comments (morphable)
News → hasMany → Likes (morphable)
Category → hasMany → News
Category → belongsTo → Category (parent, self-ref)
```
