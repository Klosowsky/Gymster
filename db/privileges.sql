create table privileges
(
    privilege_id serial
        primary key
        unique,
    name         varchar
);

alter table privileges
    owner to dbuser;

INSERT INTO public.privileges (privilege_id, name) VALUES (1, 'admin');
