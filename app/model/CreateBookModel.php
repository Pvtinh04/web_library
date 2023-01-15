<?php

class CreateBookModel extends Model
{
    public function create(array $book)
    {
        $data = [
            'name' => Str::clean($book['name']),
            'category' => Str::clean($book['category']),
            'author' => Str::clean($book['author']),
            'quantity' => Str::clean($book['quantity']),
            'avatar' => File::upload($book['avatar']),
            'description' => Str::clean($book['description']),
            'created_at' => Time::get(),
            'updated_at' => Time::get()
        ];
        $sql = Sql::query()
            ->insertInto('books (name, category, author, quantity, avatar, description, created_at, updated_at)')
            ->values('(:name, :category, :author, :quantity, :avatar, :description, :created_at, :updated_at)')
            ->get();
        $stmt = $this->pdo->prepare($sql);
        $this->bind($stmt, $data);
        $stmt->execute();
    }
}