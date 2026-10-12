# Episode 31: edits and excerpts

Changes to existing files, and summarised versions of longer files, as shown in this episode (copied from the episode script). The full files are in this folder where available and in [capstone/support-desk](../../capstone/support-desk) for the final app.

## `app/Models/Ticket.php` (edits)

```diff
diff --git a/app/Models/Ticket.php b/app/Models/Ticket.php
index 4f00382..5958135 100644
--- a/app/Models/Ticket.php
+++ b/app/Models/Ticket.php
@@ -9,6 +9,8 @@
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;
+use Illuminate\Database\Eloquent\Relations\HasMany;
+use InvalidArgumentException;
 
 /**
  * @property int $id
@@ -65,4 +67,48 @@ public function assignee(): BelongsTo
     {
         return $this->belongsTo(User::class, 'assignee_id');
     }
+
+    /**
+     * Public replies, oldest first. Never includes internal notes.
+     *
+     * @return HasMany<Reply, $this>
+     */
+    public function replies(): HasMany
+    {
+        return $this->hasMany(Reply::class)->orderBy('id');
+    }
+
+    /**
+     * Internal notes, oldest first. Kept apart from replies.
+     *
+     * @return HasMany<InternalNote, $this>
+     */
+    public function internalNotes(): HasMany
+    {
+        return $this->hasMany(InternalNote::class)->orderBy('id');
+    }
+
+    public function addReply(User $author, string $body): Reply
+    {
+        $reply = new Reply(['body' => $body]);
+        $reply->author()->associate($author);
+        $reply->ticket()->associate($this);
+        $reply->save();
+
+        return $reply;
+    }
+
+    public function addNote(User $author, string $body): InternalNote
+    {
+        if (! $author->isAgent()) {
+            throw new InvalidArgumentException('Only agents can write internal notes.');
+        }
+
+        $note = new InternalNote(['body' => $body]);
+        $note->author()->associate($author);
+        $note->ticket()->associate($this);
+        $note->save();
+
+        return $note;
+    }
 }
```

