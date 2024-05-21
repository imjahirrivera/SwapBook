PGDMP                      |            intercambio    16.3    16.3 K    Q           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            R           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            S           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            T           1262    16398    intercambio    DATABASE        CREATE DATABASE intercambio WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Mexico.1252';
    DROP DATABASE intercambio;
                postgres    false            �            1259    16399    administrador    TABLE     �   CREATE TABLE public.administrador (
    codigo_maestro integer NOT NULL,
    nombre_completo character varying(100),
    correo character varying(100),
    "contraseña" character varying(255),
    foto_perfil character varying(255)
);
 !   DROP TABLE public.administrador;
       public         heap    postgres    false            �            1259    16404    chat    TABLE     �   CREATE TABLE public.chat (
    id integer NOT NULL,
    usuario_emisor_id integer,
    usuario_emisor character varying(100),
    usuario_receptor_id integer,
    usuario_receptor character varying(100),
    mensaje text
);
    DROP TABLE public.chat;
       public         heap    postgres    false            �            1259    16409    chat_id_seq    SEQUENCE     �   CREATE SEQUENCE public.chat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.chat_id_seq;
       public          postgres    false    216            U           0    0    chat_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.chat_id_seq OWNED BY public.chat.id;
          public          postgres    false    217            �            1259    16410    libro    TABLE     �  CREATE TABLE public.libro (
    id integer NOT NULL,
    titulo character varying(50),
    autor character varying(100),
    isbn character varying(50),
    estatus boolean DEFAULT true,
    estado_fisico character varying(10),
    imagen_portada character varying(255),
    sinopsis text,
    editorial character varying(100),
    num_paginas integer,
    poseedor_id integer,
    categorias character varying(250),
    idioma character varying(30)
);
    DROP TABLE public.libro;
       public         heap    postgres    false            �            1259    16416    libro_id_seq    SEQUENCE     �   CREATE SEQUENCE public.libro_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.libro_id_seq;
       public          postgres    false    218            V           0    0    libro_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.libro_id_seq OWNED BY public.libro.id;
          public          postgres    false    219            �            1259    16417    lista_espera    TABLE     u   CREATE TABLE public.lista_espera (
    id_lista integer NOT NULL,
    id_libro integer,
    id_estudiante integer
);
     DROP TABLE public.lista_espera;
       public         heap    postgres    false            �            1259    16420    lista_espera_lista_id_seq    SEQUENCE     �   CREATE SEQUENCE public.lista_espera_lista_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.lista_espera_lista_id_seq;
       public          postgres    false    220            W           0    0    lista_espera_lista_id_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.lista_espera_lista_id_seq OWNED BY public.lista_espera.id_lista;
          public          postgres    false    221            �            1259    16421    prestamo    TABLE     s  CREATE TABLE public.prestamo (
    id integer NOT NULL,
    usuario_solicitante_id integer,
    usuario_solicitante character varying(100),
    usuario_prestamista_id integer,
    usuario_prestamista character varying(100),
    fecha_prestamo timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    fecha_devolucion timestamp without time zone,
    libro_emisor_id integer,
    libro_emisor character varying(100),
    libro_receptor_id integer,
    libro_receptor character varying(100),
    fecha_inicio_prestamo timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    fecha_fin_prestamo timestamp without time zone
);
    DROP TABLE public.prestamo;
       public         heap    postgres    false            �            1259    16426    prestamo_id_seq    SEQUENCE     �   CREATE SEQUENCE public.prestamo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.prestamo_id_seq;
       public          postgres    false    222            X           0    0    prestamo_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.prestamo_id_seq OWNED BY public.prestamo.id;
          public          postgres    false    223            �            1259    16535    registro_admin    TABLE     �  CREATE TABLE public.registro_admin (
    id integer NOT NULL,
    nombre_completo character varying(100) NOT NULL,
    correo_electronico character varying(100) NOT NULL,
    numero_telefono character varying(20) NOT NULL,
    codigo_academicos character varying(20) NOT NULL,
    "contraseña" character varying(100) NOT NULL,
    razon text NOT NULL,
    fecha_registro timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
 "   DROP TABLE public.registro_admin;
       public         heap    postgres    false            �            1259    16534    registro_admin_id_seq    SEQUENCE     �   CREATE SEQUENCE public.registro_admin_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.registro_admin_id_seq;
       public          postgres    false    230            Y           0    0    registro_admin_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.registro_admin_id_seq OWNED BY public.registro_admin.id;
          public          postgres    false    229            �            1259    16427    reportes    TABLE     V  CREATE TABLE public.reportes (
    id integer NOT NULL,
    usuario_reportante_id integer,
    usuario_reportante character varying(100),
    usuario_reportado_id integer,
    usuario_reportado character varying(100),
    descripcion text,
    fecha timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    estado character varying(100)
);
    DROP TABLE public.reportes;
       public         heap    postgres    false            �            1259    16433    reportes_id_seq    SEQUENCE     �   CREATE SEQUENCE public.reportes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.reportes_id_seq;
       public          postgres    false    224            Z           0    0    reportes_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.reportes_id_seq OWNED BY public.reportes.id;
          public          postgres    false    225            �            1259    16527    solicitud_administrador    TABLE     �   CREATE TABLE public.solicitud_administrador (
    codigo_maestro integer NOT NULL,
    nombre_completo character varying(100),
    correo character varying(100),
    "contraseña" character varying(255),
    foto_perfil character varying(255)
);
 +   DROP TABLE public.solicitud_administrador;
       public         heap    postgres    false            �            1259    16544    solicitud_prestamos    TABLE       CREATE TABLE public.solicitud_prestamos (
    id integer DEFAULT nextval('public.libro_id_seq'::regclass) NOT NULL,
    id_libro integer,
    id_solicitante integer,
    id_propietario integer,
    status_solicitante character varying,
    status_propietario character varying
);
 '   DROP TABLE public.solicitud_prestamos;
       public         heap    postgres    false    219            �            1259    16434    usuarios    TABLE     J  CREATE TABLE public.usuarios (
    id integer NOT NULL,
    nombre_completo character varying(100),
    correo character varying(100),
    "contraseña" character varying(255),
    telefono character varying(20),
    codigo_estudiante character varying(20),
    foto_perfil character varying(255),
    foto_credencial character varying(255),
    strikes integer DEFAULT 0,
    baneado boolean DEFAULT false,
    fecha_baneo timestamp without time zone,
    baneado_permanente boolean DEFAULT false,
    estado character varying(50) DEFAULT 'usuario no registrado'::character varying
);
    DROP TABLE public.usuarios;
       public         heap    postgres    false            �            1259    16443    usuarios_id_seq    SEQUENCE     �   CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.usuarios_id_seq;
       public          postgres    false    226            [           0    0    usuarios_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;
          public          postgres    false    227            z           2604    16444    chat id    DEFAULT     b   ALTER TABLE ONLY public.chat ALTER COLUMN id SET DEFAULT nextval('public.chat_id_seq'::regclass);
 6   ALTER TABLE public.chat ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    216            {           2604    16445    libro id    DEFAULT     d   ALTER TABLE ONLY public.libro ALTER COLUMN id SET DEFAULT nextval('public.libro_id_seq'::regclass);
 7   ALTER TABLE public.libro ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    219    218            }           2604    16446    lista_espera id_lista    DEFAULT     ~   ALTER TABLE ONLY public.lista_espera ALTER COLUMN id_lista SET DEFAULT nextval('public.lista_espera_lista_id_seq'::regclass);
 D   ALTER TABLE public.lista_espera ALTER COLUMN id_lista DROP DEFAULT;
       public          postgres    false    221    220            ~           2604    16447    prestamo id    DEFAULT     j   ALTER TABLE ONLY public.prestamo ALTER COLUMN id SET DEFAULT nextval('public.prestamo_id_seq'::regclass);
 :   ALTER TABLE public.prestamo ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    222            �           2604    16538    registro_admin id    DEFAULT     v   ALTER TABLE ONLY public.registro_admin ALTER COLUMN id SET DEFAULT nextval('public.registro_admin_id_seq'::regclass);
 @   ALTER TABLE public.registro_admin ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    229    230    230            �           2604    16448    reportes id    DEFAULT     j   ALTER TABLE ONLY public.reportes ALTER COLUMN id SET DEFAULT nextval('public.reportes_id_seq'::regclass);
 :   ALTER TABLE public.reportes ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    224            �           2604    16449    usuarios id    DEFAULT     j   ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);
 :   ALTER TABLE public.usuarios ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    227    226            >          0    16399    administrador 
   TABLE DATA           l   COPY public.administrador (codigo_maestro, nombre_completo, correo, "contraseña", foto_perfil) FROM stdin;
    public          postgres    false    215   �a       ?          0    16404    chat 
   TABLE DATA           u   COPY public.chat (id, usuario_emisor_id, usuario_emisor, usuario_receptor_id, usuario_receptor, mensaje) FROM stdin;
    public          postgres    false    216   b       A          0    16410    libro 
   TABLE DATA           �   COPY public.libro (id, titulo, autor, isbn, estatus, estado_fisico, imagen_portada, sinopsis, editorial, num_paginas, poseedor_id, categorias, idioma) FROM stdin;
    public          postgres    false    218   �b       C          0    16417    lista_espera 
   TABLE DATA           I   COPY public.lista_espera (id_lista, id_libro, id_estudiante) FROM stdin;
    public          postgres    false    220   Bg       E          0    16421    prestamo 
   TABLE DATA             COPY public.prestamo (id, usuario_solicitante_id, usuario_solicitante, usuario_prestamista_id, usuario_prestamista, fecha_prestamo, fecha_devolucion, libro_emisor_id, libro_emisor, libro_receptor_id, libro_receptor, fecha_inicio_prestamo, fecha_fin_prestamo) FROM stdin;
    public          postgres    false    222   }g       M          0    16535    registro_admin 
   TABLE DATA           �   COPY public.registro_admin (id, nombre_completo, correo_electronico, numero_telefono, codigo_academicos, "contraseña", razon, fecha_registro) FROM stdin;
    public          postgres    false    230   �g       G          0    16427    reportes 
   TABLE DATA           �   COPY public.reportes (id, usuario_reportante_id, usuario_reportante, usuario_reportado_id, usuario_reportado, descripcion, fecha, estado) FROM stdin;
    public          postgres    false    224   [h       K          0    16527    solicitud_administrador 
   TABLE DATA           v   COPY public.solicitud_administrador (codigo_maestro, nombre_completo, correo, "contraseña", foto_perfil) FROM stdin;
    public          postgres    false    228   xh       N          0    16544    solicitud_prestamos 
   TABLE DATA           �   COPY public.solicitud_prestamos (id, id_libro, id_solicitante, id_propietario, status_solicitante, status_propietario) FROM stdin;
    public          postgres    false    231   �h       I          0    16434    usuarios 
   TABLE DATA           �   COPY public.usuarios (id, nombre_completo, correo, "contraseña", telefono, codigo_estudiante, foto_perfil, foto_credencial, strikes, baneado, fecha_baneo, baneado_permanente, estado) FROM stdin;
    public          postgres    false    226   �h       \           0    0    chat_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.chat_id_seq', 1, false);
          public          postgres    false    217            ]           0    0    libro_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.libro_id_seq', 74, true);
          public          postgres    false    219            ^           0    0    lista_espera_lista_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.lista_espera_lista_id_seq', 5, true);
          public          postgres    false    221            _           0    0    prestamo_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.prestamo_id_seq', 1, false);
          public          postgres    false    223            `           0    0    registro_admin_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.registro_admin_id_seq', 1, true);
          public          postgres    false    229            a           0    0    reportes_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.reportes_id_seq', 1, false);
          public          postgres    false    225            b           0    0    usuarios_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.usuarios_id_seq', 10, true);
          public          postgres    false    227            �           2606    16451 &   administrador administrador_correo_key 
   CONSTRAINT     c   ALTER TABLE ONLY public.administrador
    ADD CONSTRAINT administrador_correo_key UNIQUE (correo);
 P   ALTER TABLE ONLY public.administrador DROP CONSTRAINT administrador_correo_key;
       public            postgres    false    215            �           2606    16453     administrador administrador_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.administrador
    ADD CONSTRAINT administrador_pkey PRIMARY KEY (codigo_maestro);
 J   ALTER TABLE ONLY public.administrador DROP CONSTRAINT administrador_pkey;
       public            postgres    false    215            �           2606    16455    chat chat_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.chat
    ADD CONSTRAINT chat_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.chat DROP CONSTRAINT chat_pkey;
       public            postgres    false    216            �           2606    16457    libro libro_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.libro
    ADD CONSTRAINT libro_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.libro DROP CONSTRAINT libro_pkey;
       public            postgres    false    218            �           2606    16461    lista_espera lista_espera_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.lista_espera
    ADD CONSTRAINT lista_espera_pkey PRIMARY KEY (id_lista);
 H   ALTER TABLE ONLY public.lista_espera DROP CONSTRAINT lista_espera_pkey;
       public            postgres    false    220            �           2606    16463    prestamo prestamo_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.prestamo DROP CONSTRAINT prestamo_pkey;
       public            postgres    false    222            �           2606    16543 "   registro_admin registro_admin_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.registro_admin
    ADD CONSTRAINT registro_admin_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.registro_admin DROP CONSTRAINT registro_admin_pkey;
       public            postgres    false    230            �           2606    16465    reportes reportes_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.reportes
    ADD CONSTRAINT reportes_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.reportes DROP CONSTRAINT reportes_pkey;
       public            postgres    false    224            �           2606    16533 4   solicitud_administrador solicitud_administrador_pkey 
   CONSTRAINT     ~   ALTER TABLE ONLY public.solicitud_administrador
    ADD CONSTRAINT solicitud_administrador_pkey PRIMARY KEY (codigo_maestro);
 ^   ALTER TABLE ONLY public.solicitud_administrador DROP CONSTRAINT solicitud_administrador_pkey;
       public            postgres    false    228            �           2606    16550 ,   solicitud_prestamos solicitud_prestamos_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.solicitud_prestamos
    ADD CONSTRAINT solicitud_prestamos_pkey PRIMARY KEY (id);
 V   ALTER TABLE ONLY public.solicitud_prestamos DROP CONSTRAINT solicitud_prestamos_pkey;
       public            postgres    false    231            �           2606    16467 '   usuarios usuarios_codigo_estudiante_key 
   CONSTRAINT     o   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_codigo_estudiante_key UNIQUE (codigo_estudiante);
 Q   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_codigo_estudiante_key;
       public            postgres    false    226            �           2606    16469    usuarios usuarios_correo_key 
   CONSTRAINT     Y   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_correo_key UNIQUE (correo);
 F   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_correo_key;
       public            postgres    false    226            �           2606    16471    usuarios usuarios_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public            postgres    false    226            �           2606    16472     chat chat_usuario_emisor_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.chat
    ADD CONSTRAINT chat_usuario_emisor_id_fkey FOREIGN KEY (usuario_emisor_id) REFERENCES public.usuarios(id);
 J   ALTER TABLE ONLY public.chat DROP CONSTRAINT chat_usuario_emisor_id_fkey;
       public          postgres    false    216    4766    226            �           2606    16477 "   chat chat_usuario_receptor_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.chat
    ADD CONSTRAINT chat_usuario_receptor_id_fkey FOREIGN KEY (usuario_receptor_id) REFERENCES public.usuarios(id);
 L   ALTER TABLE ONLY public.chat DROP CONSTRAINT chat_usuario_receptor_id_fkey;
       public          postgres    false    4766    226    216            �           2606    16482    libro libro_poosedor_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.libro
    ADD CONSTRAINT libro_poosedor_id_fkey FOREIGN KEY (poseedor_id) REFERENCES public.usuarios(id);
 F   ALTER TABLE ONLY public.libro DROP CONSTRAINT libro_poosedor_id_fkey;
       public          postgres    false    226    4766    218            �           2606    16492 '   lista_espera lista_espera_libro_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.lista_espera
    ADD CONSTRAINT lista_espera_libro_id_fkey FOREIGN KEY (id_libro) REFERENCES public.libro(id);
 Q   ALTER TABLE ONLY public.lista_espera DROP CONSTRAINT lista_espera_libro_id_fkey;
       public          postgres    false    218    220    4754            �           2606    16497 &   prestamo prestamo_libro_emisor_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_libro_emisor_id_fkey FOREIGN KEY (libro_emisor_id) REFERENCES public.libro(id);
 P   ALTER TABLE ONLY public.prestamo DROP CONSTRAINT prestamo_libro_emisor_id_fkey;
       public          postgres    false    218    222    4754            �           2606    16502 (   prestamo prestamo_libro_receptor_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_libro_receptor_id_fkey FOREIGN KEY (libro_receptor_id) REFERENCES public.libro(id);
 R   ALTER TABLE ONLY public.prestamo DROP CONSTRAINT prestamo_libro_receptor_id_fkey;
       public          postgres    false    4754    222    218            �           2606    16507 -   prestamo prestamo_usuario_prestamista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_usuario_prestamista_id_fkey FOREIGN KEY (usuario_prestamista_id) REFERENCES public.usuarios(id);
 W   ALTER TABLE ONLY public.prestamo DROP CONSTRAINT prestamo_usuario_prestamista_id_fkey;
       public          postgres    false    226    4766    222            �           2606    16512 -   prestamo prestamo_usuario_solicitante_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_usuario_solicitante_id_fkey FOREIGN KEY (usuario_solicitante_id) REFERENCES public.usuarios(id);
 W   ALTER TABLE ONLY public.prestamo DROP CONSTRAINT prestamo_usuario_solicitante_id_fkey;
       public          postgres    false    4766    226    222            �           2606    16517 +   reportes reportes_usuario_reportado_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.reportes
    ADD CONSTRAINT reportes_usuario_reportado_id_fkey FOREIGN KEY (usuario_reportado_id) REFERENCES public.usuarios(id);
 U   ALTER TABLE ONLY public.reportes DROP CONSTRAINT reportes_usuario_reportado_id_fkey;
       public          postgres    false    4766    226    224            �           2606    16522 ,   reportes reportes_usuario_reportante_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.reportes
    ADD CONSTRAINT reportes_usuario_reportante_id_fkey FOREIGN KEY (usuario_reportante_id) REFERENCES public.usuarios(id);
 V   ALTER TABLE ONLY public.reportes DROP CONSTRAINT reportes_usuario_reportante_id_fkey;
       public          postgres    false    224    4766    226            >   �   x�3220�4��0��J��,Rp�I�J�K)�W�,K-JTp,K��/������@�sJs���JS��r+8U�*UT�r���K�,�J���B}���BJK�K+�âL��}�K���
�S<�ͫ�MS9����b���� �-      ?      x������ � �      A   �  x��U͎�6>s���y��^[V��fӤM� ��(P��c�[�tI��m�r(�~�~#�ޤ	��$����3���	����͖�3Y��5xQ?���6��FM&������Vk�K���FOW1�����生�c�es����h���F�ߺ�M�e����lcr��۳�p��ݖ���Y��4z����<��.ŕ�F�cjZ��1��뢝�m.��\�e�˖�k����_K��t��k���6Xj8��Y��]�9J��O)�6�(zO�q�$Ա�,�@3\���y��{�v>F�&��k8�m�-��rB!C�-J߄����z�Ѭ��5��,�N�I�rA�K}�@EC�����kN}���θFJ<��L�R�p�ߝ�N-�*5W�Æ�c�+�\,��U��J�}��ԳE=�ϯ��UUW��[n\��{�jf&���y��-��X�knA9�7���;�C��y
\H�r_j�e��&q��n��n��ӞE���P��#u�cרY=USu��~�(7yG�����k��Q�`�\ ���D��@Y���Ts5^��1p�7��ᖖ��>��p=�Xq�Hx@����,	"sx�A��ǋ�D��C�[�W|��@�84�JK�q)��
��P�&�p�����&. ��b�<Ō� VѷB�q��q'�D��eHgi7�O����H��%!�9��:
�wڀ�o ��S.���׊�ӥ��e�P�8��g��ńl�56�C)Ji�ia�ktmX�aJ-�&Pn��b�4$5�G+�'��if �p�i�|�xq�31��-%i�e��''��d6��ո~����2v1^̮��r��PcN	�|N8�Ɵ����;�;�Q���[7��2�0� ���S928~N "	&F�n`�A�K��8��a������:|�@M�Եi��E<`�(���'�	|���QFw6��H�5?&�������JUj�<��;k�/��zϩ����R�����H����J,��z!~�d�%��N�O�U��|���u0���@G��=zmh�ݟ\#�a|�8:<������c/K�e�! ���_/���w�|B�,�A�t�@w�mt��W��{�N�!�pr}�p�9�3���r1�$޻|ʱ��]����a8})�d<�����ȹ��]\\��}4      C   +   x�3�4�4220�4��0�2�4D�p�"��\��\�=... P9
p      E      x������ � �      M   �   x�ʻ�0��<EV��#m�I415�>�
��Z���7����I����q���ɬ���[M㇮LKʟ2�o}����\ݘ�����Q�ǥB%B�� ���s�G��v�(�β�-V��|������� �,�����=ͦO���"'Kc���a� D�@\D�PHT�wd��},�7�      G      x������ � �      K      x������ � �      N   W   x�37�45�4220�4��0�4�t�+)JMOL�G���,9�L8M�*27�47@Re�閙���YR朘���VfD���&D����� f3�      I   �  x���[O�@��˯��WJ�ӹ���E�И�M;�Y��R�i=�9�6�&{gv2��k�� ڦ�b���l�Z���/��m��j�x���\���.̥��-/�G5���<Z��>M���|<1��'A�"�t�T�T����4E�5&4�E햹̺���Rjp���`�i�Td�w�� �:"\j�z�G��oF4�U�����˚0ig��"'i��-�A��E2����=�2�voQ�+p���8�	��Oh�x����/��!���&T���Ū+�t�$Bn�Aڿ��B*�`D�Έ�	�0l�������Wx���#u�NR��ZK���ɡ9g���r�.����h�`�x�p�@=sb��ζ-^�{+zAqm@�s�Q"����/O���q����
l[�����$�{�s��������&ʼ��q ��B���Z͚��h�;�ƣ�qox.m/�����Gc|{M�b�[].��	�b��Umt��}.���Z� ��pt�����:H�B���כ)��O}gZg>.eԄ>kl>�����7�&�M�+S�d^�h7�V�S�q����s*^o̩%��iw�!���K�e�EA-�-N0c�r�/`�:$c����)rI5� G�Ҵ�L�9��j���]�)     