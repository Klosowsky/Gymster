create table countries
(
    country_id serial
        constraint countries_pk
            primary key
        unique,
    name       varchar
);

alter table countries
    owner to dbuser;

INSERT INTO public.countries (country_id, name) VALUES (1, 'Poland');
