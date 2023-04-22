create table user_details
(
    user_detail_id serial
        constraint user_details_pk
            primary key
        constraint user_details_pk2
            unique,
    country_id     integer not null
        constraint user_details_countries_country_id_fk
            references countries,
    first_name     varchar,
    second_name    varchar,
    email          varchar,
    image          varchar
);

alter table user_details
    owner to dbuser;

INSERT INTO public.user_details (user_detail_id, country_id, first_name, second_name, email, image) VALUES (3, 1, 'Mateusz', 'klos', 'matklos@email.com', 'image');
INSERT INTO public.user_details (user_detail_id, country_id, first_name, second_name, email, image) VALUES (4, 1, 'Mateusz', 'klos', 'matklos@email.com', 'image');
INSERT INTO public.user_details ( country_id, first_name, second_name, email, image) VALUES ( 1, 'Mateuusz', 'kloos', 'matkloos@email.com', 'imaage') RETURNING user_detail_id;
INSERT INTO public.users (user_id, privilege_id, username, password) VALUES (7, 1, 'teeest_user', 'pass');


SELECT nextval(user_details_user_detail_id_seq.);
SELECT setval('user_details_user_detail_id_seq',5) ;
