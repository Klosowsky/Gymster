create sequence public.exercises_exercise_id_seq
    as integer;

alter sequence public.exercises_exercise_id_seq owner to dbuser;

alter sequence public.exercises_exercise_id_seq owned by public.exercises.exercise_id;

create sequence public.countries_country_id_seq
    as integer;

alter sequence public.countries_country_id_seq owner to dbuser;

alter sequence public.countries_country_id_seq owned by public.countries.country_id;

create sequence public.user_details_user_detail_id_seq
    as integer;

alter sequence public.user_details_user_detail_id_seq owner to dbuser;

alter sequence public.user_details_user_detail_id_seq owned by public.user_details.user_detail_id;

create sequence public.privileges_privilege_id_seq
    as integer;

alter sequence public.privileges_privilege_id_seq owner to dbuser;

alter sequence public.privileges_privilege_id_seq owned by public.privileges.privilege_id;

create sequence public.users_user_id_seq
    as integer;

alter sequence public.users_user_id_seq owner to dbuser;

alter sequence public.users_user_id_seq owned by public.users.user_id;

create sequence public.trainings_training_id_seq
    as integer;

alter sequence public.trainings_training_id_seq owner to dbuser;

alter sequence public.trainings_training_id_seq owned by public.trainings.training_id;

create sequence public.training_days_training_day_id_seq
    as integer;

alter sequence public.training_days_training_day_id_seq owner to dbuser;

alter sequence public.training_days_training_day_id_seq owned by public.training_days.training_day_id;

