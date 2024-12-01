create table post
(
    id      integer not null
        constraint post_pk
            primary key autoincrement,
    subject text not null,
    content text not null
);
CREATE TABLE creatures (
    id INTEGER NOT NULL CONSTRAINT creature_pk PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    lifespan INTEGER NOT NULL CHECK (lifespan > 0)
);