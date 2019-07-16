--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: setup; Type: TYPE; Schema: public; Owner: michielswaanen
--

CREATE TYPE setup AS ENUM (
    'EMAIL_VERIFICATION',
    'INFORMATION_SETUP',
    'AVATAR_SETUP',
    'FINISHED'
);


ALTER TYPE setup OWNER TO michielswaanen;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: account; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE account (
    account_id integer NOT NULL,
    first_name character varying(35),
    last_name character varying(35),
    email character varying(50),
    password character varying(256),
    birth_date date,
    city character varying(35),
    phone character varying(35),
    avatar character varying(100),
    setup_process setup DEFAULT 'EMAIL_VERIFICATION'::setup,
    admin boolean DEFAULT false,
    created_at timestamp without time zone DEFAULT now(),
    deleted boolean DEFAULT false
);


ALTER TABLE account OWNER TO michielswaanen;

--
-- Name: account_account_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE account_account_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE account_account_id_seq OWNER TO michielswaanen;

--
-- Name: account_account_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE account_account_id_seq OWNED BY account.account_id;


--
-- Name: account_confirmation; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE account_confirmation (
    account_id integer,
    confirmation_code integer,
    expires_at timestamp without time zone DEFAULT (now() + '01:00:00'::interval)
);


ALTER TABLE account_confirmation OWNER TO michielswaanen;

--
-- Name: account_recovery; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE account_recovery (
    account_recovery_id integer NOT NULL,
    account_id integer,
    recovery_code integer,
    expires_at timestamp without time zone DEFAULT (now() + '01:00:00'::interval),
    created_at timestamp without time zone DEFAULT now(),
    deleted boolean DEFAULT false
);


ALTER TABLE account_recovery OWNER TO michielswaanen;

--
-- Name: account_recovery_account_recovery_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE account_recovery_account_recovery_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE account_recovery_account_recovery_id_seq OWNER TO michielswaanen;

--
-- Name: account_recovery_account_recovery_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE account_recovery_account_recovery_id_seq OWNED BY account_recovery.account_recovery_id;


--
-- Name: artist; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE artist (
    artist_id integer NOT NULL,
    genre_id integer,
    name character varying(50),
    avatar character varying(100)
);


ALTER TABLE artist OWNER TO michielswaanen;

--
-- Name: artist_artist_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE artist_artist_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE artist_artist_id_seq OWNER TO michielswaanen;

--
-- Name: artist_artist_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE artist_artist_id_seq OWNED BY artist.artist_id;


--
-- Name: booking; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE booking (
    booking_id integer NOT NULL,
    artist_id integer,
    party_id integer,
    start_time_performance timestamp without time zone,
    end_time_performance timestamp without time zone,
    cancelled boolean DEFAULT false
);


ALTER TABLE booking OWNER TO michielswaanen;

--
-- Name: booking_booking_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE booking_booking_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE booking_booking_id_seq OWNER TO michielswaanen;

--
-- Name: booking_booking_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE booking_booking_id_seq OWNED BY booking.booking_id;


--
-- Name: chat; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE chat (
    chat_id integer NOT NULL,
    account_id integer,
    organizer_id integer,
    sent_by_organizer boolean,
    message character varying(256),
    seen boolean DEFAULT false,
    deleted boolean DEFAULT false,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE chat OWNER TO michielswaanen;

--
-- Name: chat_chat_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE chat_chat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE chat_chat_id_seq OWNER TO michielswaanen;

--
-- Name: chat_chat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE chat_chat_id_seq OWNED BY chat.chat_id;


--
-- Name: following; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE following (
    follower_account_id integer,
    following_account_id integer,
    following_party_id integer,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE following OWNER TO michielswaanen;

--
-- Name: genre; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE genre (
    genre_id integer NOT NULL,
    name character varying(25),
    popularity integer,
    background_image character varying(50)
);


ALTER TABLE genre OWNER TO michielswaanen;

--
-- Name: genre_genre_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE genre_genre_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE genre_genre_id_seq OWNER TO michielswaanen;

--
-- Name: genre_genre_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE genre_genre_id_seq OWNED BY genre.genre_id;


--
-- Name: menu; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE menu (
    menu_id integer NOT NULL,
    party_id integer,
    name character varying(50),
    price_in_coupons integer,
    age_restriction integer,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE menu OWNER TO michielswaanen;

--
-- Name: menu_menu_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE menu_menu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE menu_menu_id_seq OWNER TO michielswaanen;

--
-- Name: menu_menu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE menu_menu_id_seq OWNED BY menu.menu_id;


--
-- Name: message; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE message (
    message_id integer NOT NULL,
    type character varying(25),
    message character varying(511),
    created_at timestamp without time zone DEFAULT now(),
    deleted boolean DEFAULT false
);


ALTER TABLE message OWNER TO michielswaanen;

--
-- Name: message_message_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE message_message_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE message_message_id_seq OWNER TO michielswaanen;

--
-- Name: message_message_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE message_message_id_seq OWNED BY message.message_id;


--
-- Name: notification; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE notification (
    notification_id integer NOT NULL,
    party_id integer,
    message_id integer,
    account_id integer,
    action character varying(100),
    visible timestamp without time zone DEFAULT now(),
    opened boolean DEFAULT false,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE notification OWNER TO michielswaanen;

--
-- Name: notification_notification_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE notification_notification_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE notification_notification_id_seq OWNER TO michielswaanen;

--
-- Name: notification_notification_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE notification_notification_id_seq OWNED BY notification.notification_id;


--
-- Name: organizer; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE organizer (
    organizer_id integer NOT NULL,
    account_id integer,
    organisation_name character varying(35),
    description character varying(511),
    contact_phone character varying(20),
    contact_email character varying(50),
    verified boolean DEFAULT false,
    avatar character varying(100) DEFAULT './public/images/uploaded/organizer/avatar/organizer-0.jpg'::character varying,
    created_at timestamp without time zone DEFAULT now(),
    deleted boolean DEFAULT false
);


ALTER TABLE organizer OWNER TO michielswaanen;

--
-- Name: organizer_organizer_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE organizer_organizer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE organizer_organizer_id_seq OWNER TO michielswaanen;

--
-- Name: organizer_organizer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE organizer_organizer_id_seq OWNED BY organizer.organizer_id;


--
-- Name: party; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE party (
    party_id integer NOT NULL,
    genre_id integer,
    organizer_id integer,
    name character varying(50),
    description character varying(511),
    card_image character varying(100),
    background_image character varying(100),
    trailer_video character varying(100) DEFAULT NULL::character varying,
    province character varying(35),
    city character varying(35),
    address character varying(35),
    created_at timestamp without time zone DEFAULT now(),
    deleted boolean DEFAULT false,
    active boolean DEFAULT false
);


ALTER TABLE party OWNER TO michielswaanen;

--
-- Name: party_information; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE party_information (
    party_id integer,
    social_facebook character varying(100),
    social_instagram character varying(100),
    social_twitter character varying(100),
    start_time_party timestamp without time zone,
    end_time_party timestamp without time zone,
    age_restriction integer,
    coupon_price double precision,
    coupon_amount_buy_in integer,
    cloakroom_price double precision,
    start_time_hh timestamp without time zone,
    end_time_hh timestamp without time zone
);


ALTER TABLE party_information OWNER TO michielswaanen;

--
-- Name: party_party_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE party_party_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE party_party_id_seq OWNER TO michielswaanen;

--
-- Name: party_party_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE party_party_id_seq OWNED BY party.party_id;


--
-- Name: party_photo; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE party_photo (
    party_photo_id integer NOT NULL,
    party_id integer,
    path character varying(100),
    deleted boolean DEFAULT false
);


ALTER TABLE party_photo OWNER TO michielswaanen;

--
-- Name: party_photo_party_photo_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE party_photo_party_photo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE party_photo_party_photo_id_seq OWNER TO michielswaanen;

--
-- Name: party_photo_party_photo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE party_photo_party_photo_id_seq OWNED BY party_photo.party_photo_id;


--
-- Name: purchase; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE purchase (
    purchase_id integer NOT NULL,
    account_id integer,
    ticket_id integer,
    quantity integer,
    created_at timestamp without time zone DEFAULT now(),
    deleted boolean DEFAULT false
);


ALTER TABLE purchase OWNER TO michielswaanen;

--
-- Name: purchase_purchase_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE purchase_purchase_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE purchase_purchase_id_seq OWNER TO michielswaanen;

--
-- Name: purchase_purchase_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE purchase_purchase_id_seq OWNED BY purchase.purchase_id;


--
-- Name: rating; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE rating (
    rating_id integer NOT NULL,
    party_id integer,
    organizer_id integer,
    account_id integer,
    rating integer,
    title character varying(100),
    comment character varying(511),
    anonymous boolean,
    created_at timestamp without time zone DEFAULT now(),
    deleted boolean DEFAULT false
);


ALTER TABLE rating OWNER TO michielswaanen;

--
-- Name: rating_rating_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE rating_rating_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rating_rating_id_seq OWNER TO michielswaanen;

--
-- Name: rating_rating_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE rating_rating_id_seq OWNED BY rating.rating_id;


--
-- Name: ticket; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE ticket (
    ticket_id integer NOT NULL,
    party_id integer,
    name character varying(50),
    description character varying(511),
    total_quantity_available integer,
    quantity_available integer,
    price double precision,
    start_time_sale timestamp without time zone,
    end_time_sale timestamp without time zone,
    refund boolean,
    created_at timestamp without time zone DEFAULT now(),
    deleted boolean DEFAULT false
);


ALTER TABLE ticket OWNER TO michielswaanen;

--
-- Name: ticket_ticket_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE ticket_ticket_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ticket_ticket_id_seq OWNER TO michielswaanen;

--
-- Name: ticket_ticket_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE ticket_ticket_id_seq OWNED BY ticket.ticket_id;


--
-- Name: waiting_list; Type: TABLE; Schema: public; Owner: michielswaanen; Tablespace: 
--

CREATE TABLE waiting_list (
    waiting_list_id integer NOT NULL,
    account_id integer,
    ticket_id integer,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE waiting_list OWNER TO michielswaanen;

--
-- Name: waiting_list_waiting_list_id_seq; Type: SEQUENCE; Schema: public; Owner: michielswaanen
--

CREATE SEQUENCE waiting_list_waiting_list_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE waiting_list_waiting_list_id_seq OWNER TO michielswaanen;

--
-- Name: waiting_list_waiting_list_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: michielswaanen
--

ALTER SEQUENCE waiting_list_waiting_list_id_seq OWNED BY waiting_list.waiting_list_id;


--
-- Name: account_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY account ALTER COLUMN account_id SET DEFAULT nextval('account_account_id_seq'::regclass);


--
-- Name: account_recovery_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY account_recovery ALTER COLUMN account_recovery_id SET DEFAULT nextval('account_recovery_account_recovery_id_seq'::regclass);


--
-- Name: artist_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY artist ALTER COLUMN artist_id SET DEFAULT nextval('artist_artist_id_seq'::regclass);


--
-- Name: booking_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY booking ALTER COLUMN booking_id SET DEFAULT nextval('booking_booking_id_seq'::regclass);


--
-- Name: chat_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY chat ALTER COLUMN chat_id SET DEFAULT nextval('chat_chat_id_seq'::regclass);


--
-- Name: genre_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY genre ALTER COLUMN genre_id SET DEFAULT nextval('genre_genre_id_seq'::regclass);


--
-- Name: menu_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY menu ALTER COLUMN menu_id SET DEFAULT nextval('menu_menu_id_seq'::regclass);


--
-- Name: message_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY message ALTER COLUMN message_id SET DEFAULT nextval('message_message_id_seq'::regclass);


--
-- Name: notification_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY notification ALTER COLUMN notification_id SET DEFAULT nextval('notification_notification_id_seq'::regclass);


--
-- Name: organizer_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY organizer ALTER COLUMN organizer_id SET DEFAULT nextval('organizer_organizer_id_seq'::regclass);


--
-- Name: party_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY party ALTER COLUMN party_id SET DEFAULT nextval('party_party_id_seq'::regclass);


--
-- Name: party_photo_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY party_photo ALTER COLUMN party_photo_id SET DEFAULT nextval('party_photo_party_photo_id_seq'::regclass);


--
-- Name: purchase_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY purchase ALTER COLUMN purchase_id SET DEFAULT nextval('purchase_purchase_id_seq'::regclass);


--
-- Name: rating_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY rating ALTER COLUMN rating_id SET DEFAULT nextval('rating_rating_id_seq'::regclass);


--
-- Name: ticket_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY ticket ALTER COLUMN ticket_id SET DEFAULT nextval('ticket_ticket_id_seq'::regclass);


--
-- Name: waiting_list_id; Type: DEFAULT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY waiting_list ALTER COLUMN waiting_list_id SET DEFAULT nextval('waiting_list_waiting_list_id_seq'::regclass);


--
-- Data for Name: account; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO account VALUES (6, 'Jeroen', 'Put', 'lode.jorissen@uhasselt.be', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '2019-06-13', 'Kuringen', '0495812346', './public/images/uploaded/account/avatar-6.jpg', 'FINISHED', false, '2019-06-03 11:43:48.390897', false);
INSERT INTO account VALUES (2, 'John', 'Doe', 'organisator@fuiver.be', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '2000-08-10', 'Kuringen', '0495812458', './public/images/uploaded/account/avatar-2.png', 'FINISHED', false, '2019-05-30 15:20:28.425941', false);
INSERT INTO account VALUES (3, 'John', 'Admin', 'admin@fuiver.be', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '2000-08-10', 'Genk', '0495812458', './public/images/uploaded/account/avatar-3.png', 'FINISHED', true, '2019-05-30 18:13:53.752758', false);
INSERT INTO account VALUES (4, 'Jane', 'Doe', 'gebruiker@fuiver.be', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '2000-08-10', 'Kiewit', '0495812458', './public/images/uploaded/account/avatar-4.jpg', 'FINISHED', false, '2019-05-30 18:17:53.310607', false);
INSERT INTO account VALUES (1, 'Michiel', 'Swaanen', 'michiel.swaanen@hotmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '2000-08-10', 'Hasselt', '0495812458', './public/images/uploaded/account/avatar-1.jpg', 'FINISHED', false, '2019-05-30 15:13:44.279516', false);
INSERT INTO account VALUES (5, 'Michiel', 'Swaanen', 'michiel.swaanen.gsm@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, NULL, NULL, NULL, 'EMAIL_VERIFICATION', false, '2019-06-03 11:42:33.163983', false);


--
-- Name: account_account_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('account_account_id_seq', 6, true);


--
-- Data for Name: account_confirmation; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO account_confirmation VALUES (5, 5143754, '2019-06-03 12:42:33.222926');


--
-- Data for Name: account_recovery; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--



--
-- Name: account_recovery_account_recovery_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('account_recovery_account_recovery_id_seq', 1, true);


--
-- Data for Name: artist; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO artist VALUES (1, 2, 'DJ Fons', './public/images/uploaded/artist/artist-1.png');
INSERT INTO artist VALUES (2, 3, 'DJ Albert', './public/images/uploaded/artist/artist-2.png');
INSERT INTO artist VALUES (3, 4, 'DJ Dimitri', './public/images/uploaded/artist/artist-3.png');
INSERT INTO artist VALUES (4, 5, 'DJ Frank', './public/images/uploaded/artist/artist-4.png');
INSERT INTO artist VALUES (5, 3, 'DJ Rolf', './public/images/uploaded/artist/artist-5.png');
INSERT INTO artist VALUES (6, 5, 'DJ Cool', './public/images/uploaded/artist/artist-6.png');
INSERT INTO artist VALUES (7, 3, 'DJ Snoop', './public/images/uploaded/artist/artist-7.png');
INSERT INTO artist VALUES (8, 2, 'DJ Goo', './public/images/uploaded/artist/artist-8.png');
INSERT INTO artist VALUES (9, 2, 'DJ Kid', './public/images/uploaded/artist/artist-9.png');
INSERT INTO artist VALUES (10, 3, 'DJ Teletubie', './public/images/uploaded/artist/artist-10.png');
INSERT INTO artist VALUES (11, 2, 'DJ Ketnet', './public/images/uploaded/artist/artist-11.png');
INSERT INTO artist VALUES (12, 5, 'DJ Dab', './public/images/uploaded/artist/artist-12.png');
INSERT INTO artist VALUES (13, 4, 'DJ Khaled', './public/images/uploaded/artist/artist-13.png');
INSERT INTO artist VALUES (14, 5, 'DJ Garrix', './public/images/uploaded/artist/artist-14.png');
INSERT INTO artist VALUES (15, 3, 'DJ Wong', './public/images/uploaded/artist/artist-15.png');
INSERT INTO artist VALUES (16, 4, 'DJ Bob', './public/images/uploaded/artist/artist-16.png');
INSERT INTO artist VALUES (17, 4, 'DJ Electro', './public/images/uploaded/artist/artist-17.png');
INSERT INTO artist VALUES (18, 3, 'DJ Dub', './public/images/uploaded/artist/artist-18.png');
INSERT INTO artist VALUES (19, 2, 'DJ Home', './public/images/uploaded/artist/artist-19.png');
INSERT INTO artist VALUES (20, 1, 'DJ Bob', './public/images/uploaded/artist/artist-20.png');
INSERT INTO artist VALUES (21, 3, 'DJ Alberto', './public/images/uploaded/artist/artist-21.png');
INSERT INTO artist VALUES (22, 4, 'DJ Tim', './public/images/uploaded/artist/artist-22.png');
INSERT INTO artist VALUES (23, 4, 'DJ Tom', './public/images/uploaded/artist/artist-23.png');
INSERT INTO artist VALUES (24, 2, 'DJ Fons', './public/images/uploaded/artist/artist-24.png');
INSERT INTO artist VALUES (25, 1, 'DJ Dimitri', './public/images/uploaded/artist/artist-25.png');
INSERT INTO artist VALUES (26, 2, 'DJ Frank', './public/images/uploaded/artist/artist-26.png');


--
-- Name: artist_artist_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('artist_artist_id_seq', 26, true);


--
-- Data for Name: booking; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO booking VALUES (1, 1, 1, '2019-09-01 20:00:00', '2019-09-01 22:00:00', false);
INSERT INTO booking VALUES (2, 2, 1, '2019-09-01 22:00:00', '2019-09-01 00:00:00', false);
INSERT INTO booking VALUES (3, 3, 1, '2019-09-01 00:00:00', '2019-09-01 02:00:00', false);
INSERT INTO booking VALUES (4, 4, 1, '2019-09-01 02:00:00', '2019-09-01 05:00:00', false);
INSERT INTO booking VALUES (5, 5, 2, '2019-08-10 20:00:00', '2019-08-10 22:00:00', false);
INSERT INTO booking VALUES (6, 6, 2, '2019-08-10 22:00:00', '2019-08-10 00:00:00', false);
INSERT INTO booking VALUES (7, 7, 2, '2019-08-10 00:00:00', '2019-08-10 02:00:00', false);
INSERT INTO booking VALUES (8, 8, 2, '2019-08-10 02:00:00', '2019-08-10 04:00:00', false);
INSERT INTO booking VALUES (9, 9, 3, '2019-06-30 18:00:00', '2019-06-30 20:00:00', false);
INSERT INTO booking VALUES (10, 10, 3, '2019-06-30 20:00:00', '2019-06-30 22:00:00', false);
INSERT INTO booking VALUES (11, 11, 3, '2019-06-30 22:00:00', '2019-06-30 00:00:00', false);
INSERT INTO booking VALUES (12, 12, 3, '2019-06-30 00:00:00', '2019-06-30 02:00:00', false);
INSERT INTO booking VALUES (13, 13, 4, '2019-08-01 20:00:00', '2019-08-01 22:00:00', false);
INSERT INTO booking VALUES (14, 14, 4, '2019-08-01 22:00:00', '2019-08-01 01:00:00', false);
INSERT INTO booking VALUES (15, 15, 4, '2019-08-01 01:00:00', '2019-08-01 04:00:00', false);
INSERT INTO booking VALUES (16, 16, 4, '2019-08-01 04:00:00', '2019-08-01 06:00:00', false);
INSERT INTO booking VALUES (17, 17, 5, '2019-10-01 21:00:00', '2019-10-01 23:00:00', false);
INSERT INTO booking VALUES (18, 18, 5, '2019-10-01 23:00:00', '2019-10-01 01:00:00', false);
INSERT INTO booking VALUES (19, 19, 5, '2019-10-01 01:00:00', '2019-10-01 03:00:00', false);
INSERT INTO booking VALUES (20, 20, 6, '2019-07-30 20:00:00', '2019-07-30 22:00:00', false);
INSERT INTO booking VALUES (21, 21, 6, '2019-07-30 22:00:00', '2019-07-30 00:00:00', false);
INSERT INTO booking VALUES (22, 22, 6, '2019-07-30 00:00:00', '2019-07-30 02:00:00', false);
INSERT INTO booking VALUES (23, 23, 6, '2019-07-30 02:00:00', '2019-07-30 04:00:00', false);
INSERT INTO booking VALUES (24, 24, 7, '2019-06-01 20:00:00', '2019-06-01 22:00:00', false);
INSERT INTO booking VALUES (25, 25, 7, '2019-06-01 22:00:00', '2019-06-01 00:00:00', false);
INSERT INTO booking VALUES (26, 26, 7, '2019-06-01 00:00:00', '2019-06-01 02:00:00', false);


--
-- Name: booking_booking_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('booking_booking_id_seq', 26, true);


--
-- Data for Name: chat; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO chat VALUES (1, 4, 1, false, 'Hallo! Ik heb een vraag omtrent uw fuif. Heeft u even tijd?', true, false, '2019-05-30 18:47:39.78845');
INSERT INTO chat VALUES (2, 4, 1, true, 'Natuurlijk heb ik even tijd. Wat is uw vraag mevrouw?', true, false, '2019-05-30 18:48:28.632833');
INSERT INTO chat VALUES (3, 4, 1, false, 'Zijn er taxi''s in de buurt?', true, false, '2019-05-30 18:52:17.46997');
INSERT INTO chat VALUES (4, 4, 1, true, 'Ja, er word een parking voorzien voor taxi''s dichtbij de fuif.', true, false, '2019-05-30 18:52:40.996075');
INSERT INTO chat VALUES (5, 4, 1, true, 'Hallo', false, false, '2019-06-03 11:38:19.074931');
INSERT INTO chat VALUES (6, 6, 1, false, 'Hallo', true, false, '2019-06-03 11:48:04.840716');
INSERT INTO chat VALUES (7, 6, 1, true, 'Hallo', true, false, '2019-06-03 11:48:20.307587');
INSERT INTO chat VALUES (8, 6, 1, false, 'Test', true, false, '2019-06-03 11:48:31.33509');


--
-- Name: chat_chat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('chat_chat_id_seq', 8, true);


--
-- Data for Name: following; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO following VALUES (1, 4, NULL, '2019-05-30 18:34:37.795319');
INSERT INTO following VALUES (4, 1, NULL, '2019-06-03 11:34:37.581961');


--
-- Data for Name: genre; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO genre VALUES (1, 'R&B', 0, './public/images/uploaded/genre/genre-1.jpg');
INSERT INTO genre VALUES (2, 'House', 0, './public/images/uploaded/genre/genre-2.jpg');
INSERT INTO genre VALUES (3, 'Dubstep', 0, './public/images/uploaded/genre/genre-3.jpg');
INSERT INTO genre VALUES (4, 'EDM', 0, './public/images/uploaded/genre/genre-4.jpg');
INSERT INTO genre VALUES (5, 'Dance', 0, './public/images/uploaded/genre/genre-5.jpg');


--
-- Name: genre_genre_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('genre_genre_id_seq', 5, true);


--
-- Data for Name: menu; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO menu VALUES (1, 1, 'Red bull 25cl.', 1, 12, '2019-05-30 15:48:17.099978');
INSERT INTO menu VALUES (2, 1, 'Coca Cola 25cl.', 1, 12, '2019-05-30 15:52:28.595894');
INSERT INTO menu VALUES (4, 1, 'Water 25cl.', 1, 6, '2019-05-30 15:57:06.195537');
INSERT INTO menu VALUES (5, 1, 'Bruis Water 25cl.', 1, 6, '2019-05-30 15:57:19.177889');
INSERT INTO menu VALUES (6, 1, 'Woda 10cl.', 3, 18, '2019-05-30 15:57:34.21537');
INSERT INTO menu VALUES (7, 1, 'Fristi', 1, 6, '2019-05-30 15:58:16.54116');
INSERT INTO menu VALUES (10, 2, 'Coca Cola 25cl.', 1, 6, '2019-05-30 16:17:26.085908');
INSERT INTO menu VALUES (11, 2, 'Monster Green 35cl.', 2, 16, '2019-05-30 16:17:46.059075');
INSERT INTO menu VALUES (12, 2, 'Champagne 65cl.', 4, 18, '2019-05-30 16:18:15.082255');
INSERT INTO menu VALUES (13, 3, 'Fristi 25cl', 1, 6, '2019-05-30 16:53:17.673023');
INSERT INTO menu VALUES (14, 3, 'Coca Cola 25cl.', 1, 6, '2019-05-30 16:53:28.016481');
INSERT INTO menu VALUES (15, 3, 'Water 25cl.', 1, 6, '2019-05-30 16:53:36.68761');
INSERT INTO menu VALUES (16, 3, 'Fanta 25cl.', 1, 6, '2019-05-30 16:53:46.222055');
INSERT INTO menu VALUES (17, 4, 'Wodka 25cl.', 2, 18, '2019-05-30 17:06:09.342396');
INSERT INTO menu VALUES (18, 4, 'Jenever 5cl.', 1, 18, '2019-05-30 17:07:05.732349');
INSERT INTO menu VALUES (19, 4, 'Tequilla 10cl.', 2, 18, '2019-05-30 17:07:26.542924');
INSERT INTO menu VALUES (20, 4, 'Champagne 65cl.', 4, 18, '2019-05-30 17:07:42.133976');
INSERT INTO menu VALUES (21, 5, 'Water 25cl.', 2, 6, '2019-05-30 17:22:02.604154');
INSERT INTO menu VALUES (22, 5, 'Coca Cola 25cl.', 3, 6, '2019-05-30 17:22:07.262218');
INSERT INTO menu VALUES (23, 5, 'Red bull 25cl.', 3, 12, '2019-05-30 17:22:13.711725');
INSERT INTO menu VALUES (24, 5, 'Champagne 65cl.', 9, 18, '2019-05-30 17:22:20.996017');
INSERT INTO menu VALUES (25, 6, 'Water 25cl.', 1, 6, '2019-05-30 17:29:15.005997');
INSERT INTO menu VALUES (26, 6, 'Bruis Water 25cl.', 1, 6, '2019-05-30 17:29:20.944416');
INSERT INTO menu VALUES (27, 6, 'Citroen Water 25cl.', 2, 6, '2019-05-30 17:29:31.846755');
INSERT INTO menu VALUES (28, 7, 'Water 25cl.', 2, 6, '2019-05-30 19:13:28.069867');
INSERT INTO menu VALUES (29, 7, 'Champagne 65cl.', 10, 18, '2019-05-30 19:13:39.989743');


--
-- Name: menu_menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('menu_menu_id_seq', 29, true);


--
-- Data for Name: message; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO message VALUES (1, 'Openluchtfuif Alken 2019', 'DJ Fons is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 15:44:14.029004', false);
INSERT INTO message VALUES (2, 'Openluchtfuif Alken 2019', 'DJ Albert is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 15:44:45.660504', false);
INSERT INTO message VALUES (3, 'Openluchtfuif Alken 2019', 'DJ Dimitri is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 15:45:07.618858', false);
INSERT INTO message VALUES (4, 'Openluchtfuif Alken 2019', 'DJ Frank is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 15:45:25.184157', false);
INSERT INTO message VALUES (5, 'Safari Party 2019', 'DJ Rolf is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 16:15:24.267195', false);
INSERT INTO message VALUES (6, 'Safari Party 2019', 'DJ Cool is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 16:15:40.460342', false);
INSERT INTO message VALUES (7, 'Safari Party 2019', 'DJ Snoop is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 16:16:21.792346', false);
INSERT INTO message VALUES (8, 'Safari Party 2019', 'DJ Goo is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 16:16:49.7213', false);
INSERT INTO message VALUES (9, 'Kids Disco Party 2019', 'DJ Kid is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 16:51:39.596165', false);
INSERT INTO message VALUES (10, 'Kids Disco Party 2019', 'DJ Teletubie is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 16:52:02.390518', false);
INSERT INTO message VALUES (11, 'Kids Disco Party 2019', 'DJ Ketnet is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 16:52:23.620248', false);
INSERT INTO message VALUES (12, 'Kids Disco Party 2019', 'DJ Dab is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 16:52:39.987583', false);
INSERT INTO message VALUES (13, 'Super Crazy Party 2019', 'DJ Khaled is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 17:03:57.812532', false);
INSERT INTO message VALUES (14, 'Super Crazy Party 2019', 'DJ Garrix is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 17:04:18.332375', false);
INSERT INTO message VALUES (15, 'Super Crazy Party 2019', 'DJ Wong is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 17:04:37.853219', false);
INSERT INTO message VALUES (16, 'Super Crazy Party 2019', 'DJ Bob is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 17:05:36.394922', false);
INSERT INTO message VALUES (17, 'Chacalaca Party 2019', 'DJ Electro is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 17:18:57.549664', false);
INSERT INTO message VALUES (18, 'Chacalaca Party 2019', 'DJ Dub is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 17:19:13.544059', false);
INSERT INTO message VALUES (19, 'Chacalaca Party 2019', 'DJ Home is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 17:19:39.478324', false);
INSERT INTO message VALUES (20, '90''s Party', 'DJ Bob is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 17:27:40.011489', false);
INSERT INTO message VALUES (21, '90''s Party', 'DJ Alberto is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 17:27:56.343987', false);
INSERT INTO message VALUES (22, '90''s Party', 'DJ Tim is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 17:28:13.353312', false);
INSERT INTO message VALUES (23, '90''s Party', 'DJ Tom is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 17:28:31.865878', false);
INSERT INTO message VALUES (24, 'Review', 'Laat je mening achter over Openluchtfuif Alken 2019, zij zouden dit erg warderen!', '2019-05-30 18:28:47.985517', false);
INSERT INTO message VALUES (25, 'Review', 'Laat je mening achter over Openluchtfuif Alken 2019, zij zouden dit erg warderen!', '2019-05-30 18:35:19.190901', false);
INSERT INTO message VALUES (26, 'Review', 'Laat je mening achter over Safari Party 2019, zij zouden dit erg warderen!', '2019-05-30 18:37:01.434812', false);
INSERT INTO message VALUES (27, 'Backers Party 2019', 'DJ Fons is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 19:12:40.620315', false);
INSERT INTO message VALUES (28, 'Backers Party 2019', 'DJ Dimitri is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 19:13:02.086002', false);
INSERT INTO message VALUES (29, 'Backers Party 2019', 'DJ Frank is toegevoegd aan de line-up, neem snel een kijkje op onze pagina!', '2019-05-30 19:13:14.396327', false);
INSERT INTO message VALUES (30, 'Review', 'Laat je mening achter over Backers Party 2019, zij zouden dit erg warderen!', '2019-05-30 19:14:49.336663', false);
INSERT INTO message VALUES (31, 'Review', 'Laat je mening achter over Chacalaca Party 2019, zij zouden dit erg warderen!', '2019-05-30 19:18:03.02256', false);
INSERT INTO message VALUES (32, 'Chacalaca Party 2019', 'Er zijn plaatsen vrij gekomen voor Chacalaca Party 2019! Koop snel je tickets voordat ze ingenomen zijn!', '2019-05-30 19:19:55.410618', false);
INSERT INTO message VALUES (33, 'Review', 'Laat je mening achter over Chacalaca Party 2019, zij zouden dit erg warderen!', '2019-05-30 19:20:16.893101', false);
INSERT INTO message VALUES (34, 'Review', 'Laat je mening achter over 90''s Party, zij zouden dit erg warderen!', '2019-05-30 19:27:00.93345', false);
INSERT INTO message VALUES (35, 'Review', 'Laat je mening achter over 90''s Party, zij zouden dit erg warderen!', '2019-05-30 19:27:40.430671', false);
INSERT INTO message VALUES (36, 'Chacalaca Party 2019', 'De administrator van Fuiver heeft Chacalaca Party 2019 verwijderd en daarmee is jouw ticket dus ook verwijderd. 
        De fuif werd verwijderd wegens het overschrijden van onze voorwaarden, de volledige reden kan je hier lezen: Niet leuk', '2019-06-03 11:50:16.978292', false);
INSERT INTO message VALUES (37, 'Chacalaca Party 2019', 'De administrator van Fuiver heeft Chacalaca Party 2019 verwijderd en daarmee ben jij dus ook van de wachtlijst gehaald voor deze fuif. 
        De fuif werd verwijderd wegens het overschrijden van onze voorwaarden, de volledige reden kan je hier lezen: Niet leuk', '2019-06-03 11:50:17.017293', false);
INSERT INTO message VALUES (38, 'Openluchtfuif Alken 2019', 'De administrator van Fuiver heeft Openluchtfuif Alken 2019 verwijderd en daarmee is jouw ticket dus ook verwijderd. 
        De fuif werd verwijderd wegens het overschrijden van onze voorwaarden, de volledige reden kan je hier lezen: test', '2019-06-03 11:50:33.499085', false);
INSERT INTO message VALUES (39, 'Openluchtfuif Alken 2019', 'De administrator van Fuiver heeft Openluchtfuif Alken 2019 verwijderd en daarmee ben jij dus ook van de wachtlijst gehaald voor deze fuif. 
        De fuif werd verwijderd wegens het overschrijden van onze voorwaarden, de volledige reden kan je hier lezen: test', '2019-06-03 11:50:33.515359', false);


--
-- Name: message_message_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('message_message_id_seq', 39, true);


--
-- Data for Name: notification; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO notification VALUES (2, 1, 25, 1, './rating.php?purchaseID=2', '2019-09-02 05:00:00', false, '2019-05-30 18:35:19.198407');
INSERT INTO notification VALUES (3, 2, 26, 1, './rating.php?purchaseID=3', '2019-08-10 04:00:00', false, '2019-05-30 18:37:01.441744');
INSERT INTO notification VALUES (6, 5, 32, 4, 'party.php?party=5', '2019-05-30 19:19:55.442777', true, '2019-05-30 19:19:55.442777');
INSERT INTO notification VALUES (7, 5, 33, 1, './rating.php?purchaseID=6', '2019-10-02 03:00:00', false, '2019-05-30 19:20:16.900193');
INSERT INTO notification VALUES (8, 6, 34, 4, './rating.php?purchaseID=7', '2019-07-31 04:00:00', false, '2019-05-30 19:27:00.950344');
INSERT INTO notification VALUES (9, 6, 35, 1, './rating.php?purchaseID=8', '2019-07-31 04:00:00', false, '2019-05-30 19:27:40.447093');
INSERT INTO notification VALUES (4, 7, 30, 4, './rating.php?purchaseID=4', '2019-06-02 02:00:00', true, '2019-05-30 19:14:49.343286');
INSERT INTO notification VALUES (10, 5, 36, 1, 'party.php?party=5', '2019-06-03 11:50:17.127599', false, '2019-06-03 11:50:17.127599');
INSERT INTO notification VALUES (11, 5, 36, 1, 'party.php?party=5', '2019-06-03 11:50:17.165284', false, '2019-06-03 11:50:17.165284');
INSERT INTO notification VALUES (13, 1, 38, 1, 'party.php?party=1', '2019-06-03 11:50:33.563133', false, '2019-06-03 11:50:33.563133');
INSERT INTO notification VALUES (12, 5, 37, 4, 'party.php?party=5', '2019-06-03 11:50:17.199393', true, '2019-06-03 11:50:17.199393');
INSERT INTO notification VALUES (14, 1, 38, 4, 'party.php?party=1', '2019-06-03 11:50:33.613548', true, '2019-06-03 11:50:33.613548');


--
-- Name: notification_notification_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('notification_notification_id_seq', 14, true);


--
-- Data for Name: organizer; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO organizer VALUES (1, 2, 'Party Time BVBA', NULL, '0495812458', 'hello@partytime.be', false, './public/images/uploaded/organizer/avatar/organizer-2.jpg', '2019-05-30 15:24:52.360599', false);


--
-- Name: organizer_organizer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('organizer_organizer_id_seq', 1, true);


--
-- Data for Name: party; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO party VALUES (6, 5, 1, '90''s Party', 'Feest zoals in de jaren 90, koop nu je tickets!', './public/images/uploaded/party/card/party-6.jpg', './public/images/uploaded/party/background/party-6.jpg', './public/images/uploaded/party/trailer/party-6.mp4', 'limburg', 'Kuringen', 'Meidoornlaan 23', '2019-05-30 17:25:26.747589', false, true);
INSERT INTO party VALUES (2, 2, 1, 'Safari Party 2019', 'De coolste fuif van het jaar komt weer terug! Koop snel je tickets!', './public/images/uploaded/party/card/party-2.jpg', './public/images/uploaded/party/background/party-2.jpg', './public/images/uploaded/party/trailer/party-2.mp4', 'limburg', 'Hasselt', 'Haagdoornlaan 23', '2019-05-30 16:08:28.586002', false, true);
INSERT INTO party VALUES (5, 5, 1, 'Chacalaca Party 2019', 'De fuif van het jaar, koop zeker je tickets!', './public/images/uploaded/party/card/party-5.jpg', './public/images/uploaded/party/background/party-5.jpg', './public/images/uploaded/party/trailer/party-5.mp4', 'brussel', 'Schaarbeek', 'Meidoornlaan 23', '2019-05-30 17:16:42.214433', false, true);
INSERT INTO party VALUES (1, 2, 1, 'Openluchtfuif Alken 2019', 'Een fuif georganiseerd door de chiro van Alken, de fuif van het jaar!', './public/images/uploaded/party/card/party-1.jpg', './public/images/uploaded/party/background/party-1.jpg', './public/images/uploaded/party/trailer/party-1.mp4', 'limburg', 'Alken', 'Meidoornlaan 23', '2019-05-30 15:37:49.121404', false, true);
INSERT INTO party VALUES (4, 4, 1, 'Super Crazy Party 2019', 'De meest geweldige fuif van het jaar. Koop snel je tickets!', './public/images/uploaded/party/card/party-4.jpg', './public/images/uploaded/party/background/party-4.jpg', './public/images/uploaded/party/trailer/party-4.mp4', 'west-vlaanderen', 'Brugge', 'Meidoornlaan 23', '2019-05-30 17:02:08.607096', false, true);
INSERT INTO party VALUES (3, 5, 1, 'Kids Disco Party 2019', 'Een super leuke fuif voor kinderen onder de 16 jaar! Zeker niet missen, koop je tickets!', './public/images/uploaded/party/card/party-3.jpg', './public/images/uploaded/party/background/party-3.jpg', './public/images/uploaded/party/trailer/party-3.mp4', 'antwerpen', 'Sint-job', 'Meidoornlaan 23', '2019-05-30 16:48:08.870182', false, true);
INSERT INTO party VALUES (7, 5, 1, 'Backers Party 2019', 'De beste fuif van 2019', './public/images/uploaded/party/card/party-7.jpg', './public/images/uploaded/party/background/party-7.jpg', './public/images/uploaded/party/trailer/party-7.mp4', 'limburg', 'Kuringen', 'Haagdoornlaan 23', '2019-05-30 19:09:37.122179', false, true);


--
-- Data for Name: party_information; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO party_information VALUES (4, 'https://facebook.com/scp-2019', 'https://instagram.com/scp-2019', 'https://twitter.com/scp-2019', '2019-08-01 08:00:00', '2019-08-02 06:00:00', 18, 6, 10, 1, '2019-08-01 01:00:00', '2019-08-01 02:00:00');
INSERT INTO party_information VALUES (3, 'https://facebook.com/disco-2019', 'https://instagram.com/disco-2019', 'https://twitter.com/disco-2019', '2019-06-30 19:00:00', '2019-07-01 02:00:00', 9, 3, 5, 2, '2019-06-30 19:00:00', '2019-06-30 20:00:00');
INSERT INTO party_information VALUES (7, 'https://facebook.com/backers-2019', 'https://instagram.com/backers-2019', 'https://twitter.com/backers-2019', '2019-06-01 08:00:00', '2019-06-02 02:00:00', 12, 5, 6, 2, '2019-06-01 00:00:00', '2019-06-01 01:00:00');
INSERT INTO party_information VALUES (6, 'https://facebook.com/negentig-2019', 'https://instagram.com/negentig-2019', 'https://twitter.com/negentig-2019', '2019-05-30 19:00:00', '2019-05-31 04:00:00', 12, 5, 4, 2, '2019-05-30 01:00:00', '2019-05-30 02:00:00');
INSERT INTO party_information VALUES (2, 'https://facebook.com/safari-2019', 'https://instagram.com/safari-2019', 'https://twitter.com/safari-2019', '2019-08-10 08:00:00', '2019-08-11 04:00:00', 18, 6, 5, 2, '2019-08-10 01:00:00', '2019-08-10 02:00:00');


--
-- Name: party_party_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('party_party_id_seq', 7, true);


--
-- Data for Name: party_photo; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO party_photo VALUES (1, 1, './public/images/uploaded/party/album/artist-1-0.jpg', false);
INSERT INTO party_photo VALUES (2, 1, './public/images/uploaded/party/album/artist-1-1.jpg', false);
INSERT INTO party_photo VALUES (3, 1, './public/images/uploaded/party/album/artist-1-2.jpg', false);
INSERT INTO party_photo VALUES (4, 1, './public/images/uploaded/party/album/artist-1-3.jpg', false);
INSERT INTO party_photo VALUES (5, 1, './public/images/uploaded/party/album/artist-1-4.jpg', false);
INSERT INTO party_photo VALUES (6, 5, './public/images/uploaded/party/album/artist-5-0.jpg', false);
INSERT INTO party_photo VALUES (7, 5, './public/images/uploaded/party/album/artist-5-1.jpg', false);
INSERT INTO party_photo VALUES (9, 6, './public/images/uploaded/party/album/artist-6-0.jpg', false);
INSERT INTO party_photo VALUES (10, 6, './public/images/uploaded/party/album/artist-6-1.jpg', false);
INSERT INTO party_photo VALUES (11, 6, './public/images/uploaded/party/album/artist-6-2.jpg', false);
INSERT INTO party_photo VALUES (12, 7, './public/images/uploaded/party/album/artist-7-0.jpg', false);
INSERT INTO party_photo VALUES (13, 7, './public/images/uploaded/party/album/artist-7-1.jpg', false);
INSERT INTO party_photo VALUES (14, 7, './public/images/uploaded/party/album/artist-7-2.jpg', false);


--
-- Name: party_photo_party_photo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('party_photo_party_photo_id_seq', 14, true);


--
-- Data for Name: purchase; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO purchase VALUES (2, 1, 1, 2, '2019-05-30 18:35:19.183315', false);
INSERT INTO purchase VALUES (3, 1, 3, 1, '2019-05-30 18:37:01.424722', false);
INSERT INTO purchase VALUES (4, 4, 12, 2, '2019-05-30 19:14:49.316834', false);
INSERT INTO purchase VALUES (5, 1, 13, 1, '2019-05-30 19:18:03.01368', true);
INSERT INTO purchase VALUES (6, 1, 13, 1, '2019-05-30 19:20:16.884588', false);
INSERT INTO purchase VALUES (7, 4, 11, 1, '2019-05-30 19:27:00.909255', false);
INSERT INTO purchase VALUES (8, 1, 11, 1, '2019-05-30 19:27:40.412628', false);
INSERT INTO purchase VALUES (1, 4, 2, 1, '2019-05-30 18:28:47.976836', true);


--
-- Name: purchase_purchase_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('purchase_purchase_id_seq', 8, true);


--
-- Data for Name: rating; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO rating VALUES (1, 7, 1, 4, 9, 'super', 'leuk', false, '2019-06-03 11:33:38.138924', false);


--
-- Name: rating_rating_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('rating_rating_id_seq', 1, true);


--
-- Data for Name: ticket; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO ticket VALUES (4, 2, 'Deluxe', 'Toegang tot de fuif en gratis bewaakte parkeerplaats', 250, 250, 19, '2019-01-01 00:00:00', '2019-08-10 20:00:00', false, '2019-05-30 16:14:42.232482', false);
INSERT INTO ticket VALUES (5, 3, 'Basic', 'Toegang tot onze geweldige fuif', 250, 250, 6, '2019-01-01 00:00:00', '2019-06-30 18:00:00', false, '2019-05-30 16:49:14.794657', false);
INSERT INTO ticket VALUES (6, 3, 'Super', 'Gratis drank en toegang tot onze fuif', 150, 150, 24, '2019-01-01 00:00:00', '2019-06-30 18:00:00', true, '2019-05-30 16:50:11.731447', false);
INSERT INTO ticket VALUES (7, 3, 'Deluxe', 'Gratis drank en eten, ook toegang tot onze fuif natuurlijk!', 50, 50, 46, '2019-01-01 00:00:00', '2019-06-30 18:00:00', true, '2019-05-30 16:51:09.346023', false);
INSERT INTO ticket VALUES (8, 4, 'Basic', 'Toegang tot onze fuif, en veel alcohol.', 1500, 1500, 9, '2019-01-01 00:00:00', '2019-08-01 20:00:00', true, '2019-05-30 17:03:21.385813', false);
INSERT INTO ticket VALUES (9, 5, 'Basic', 'Toegang tot onze fuif.', 2500, 2500, 5, '2019-01-01 00:00:00', '2019-10-01 21:00:00', true, '2019-05-30 17:17:25.326839', false);
INSERT INTO ticket VALUES (10, 5, 'VIP', 'Toegang tot het VIP salon en gratis drank. Ook toegang tot onze fuif!', 30, 30, 25, '2019-01-01 00:00:00', '2019-10-01 21:00:00', false, '2019-05-30 17:18:27.058472', false);
INSERT INTO ticket VALUES (1, 1, 'Basic', 'Je krijgt toegang tot de fuif weide', 3555, 3553, 6, '2019-01-01 00:00:00', '2019-09-01 20:00:00', true, '2019-05-30 15:39:48.255347', false);
INSERT INTO ticket VALUES (3, 2, 'Basic', 'Toegang tot de fijnste nacht van je leven.', 3000, 2999, 8, '2019-01-01 12:00:00', '2019-08-10 08:00:00', true, '2019-05-30 16:09:52.275977', false);
INSERT INTO ticket VALUES (12, 7, 'Basic', 'Toegang tot onze geweldige fuif', 250, 248, 6, '2019-01-01 00:00:00', '2019-06-01 20:00:00', true, '2019-05-30 19:12:19.138309', false);
INSERT INTO ticket VALUES (13, 5, 'Exclusive', 'Meet & Greet, gratis eten & drank + toegang tot fuif', 1, 0, 250, '2019-01-01 00:00:00', '2019-10-01 20:00:00', true, '2019-05-30 19:17:14.226428', false);
INSERT INTO ticket VALUES (11, 6, 'Basic', 'Toegang tot de zotste fuif van Vlaanderen', 2, 0, 5, '2019-01-01 12:00:00', '2019-07-30 04:00:00', true, '2019-05-30 17:27:10.340778', false);
INSERT INTO ticket VALUES (2, 1, 'VIP', 'Je krijgt toegang tot de fuif weide en je krijgt ook toegang tot het VIP platform.', 150, 150, 25, '2019-01-01 00:00:00', '2019-09-01 20:00:00', true, '2019-05-30 15:40:58.098508', false);


--
-- Name: ticket_ticket_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('ticket_ticket_id_seq', 13, true);


--
-- Data for Name: waiting_list; Type: TABLE DATA; Schema: public; Owner: michielswaanen
--

INSERT INTO waiting_list VALUES (1, 4, 13, '2019-05-30 19:19:45.879979');


--
-- Name: waiting_list_waiting_list_id_seq; Type: SEQUENCE SET; Schema: public; Owner: michielswaanen
--

SELECT pg_catalog.setval('waiting_list_waiting_list_id_seq', 1, true);


--
-- Name: account_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY account
    ADD CONSTRAINT account_pkey PRIMARY KEY (account_id);


--
-- Name: account_recovery_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY account_recovery
    ADD CONSTRAINT account_recovery_pkey PRIMARY KEY (account_recovery_id);


--
-- Name: artist_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY artist
    ADD CONSTRAINT artist_pkey PRIMARY KEY (artist_id);


--
-- Name: booking_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY booking
    ADD CONSTRAINT booking_pkey PRIMARY KEY (booking_id);


--
-- Name: chat_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY chat
    ADD CONSTRAINT chat_pkey PRIMARY KEY (chat_id);


--
-- Name: genre_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY genre
    ADD CONSTRAINT genre_pkey PRIMARY KEY (genre_id);


--
-- Name: menu_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY menu
    ADD CONSTRAINT menu_pkey PRIMARY KEY (menu_id);


--
-- Name: message_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY message
    ADD CONSTRAINT message_pkey PRIMARY KEY (message_id);


--
-- Name: notification_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY notification
    ADD CONSTRAINT notification_pkey PRIMARY KEY (notification_id);


--
-- Name: organizer_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY organizer
    ADD CONSTRAINT organizer_pkey PRIMARY KEY (organizer_id);


--
-- Name: party_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY party
    ADD CONSTRAINT party_pkey PRIMARY KEY (party_id);


--
-- Name: purchase_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY purchase
    ADD CONSTRAINT purchase_pkey PRIMARY KEY (purchase_id);


--
-- Name: rating_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY rating
    ADD CONSTRAINT rating_pkey PRIMARY KEY (rating_id);


--
-- Name: ticket_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY ticket
    ADD CONSTRAINT ticket_pkey PRIMARY KEY (ticket_id);


--
-- Name: waiting_list_pkey; Type: CONSTRAINT; Schema: public; Owner: michielswaanen; Tablespace: 
--

ALTER TABLE ONLY waiting_list
    ADD CONSTRAINT waiting_list_pkey PRIMARY KEY (waiting_list_id);


--
-- Name: account_confirmation_account_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY account_confirmation
    ADD CONSTRAINT account_confirmation_account_id_fkey FOREIGN KEY (account_id) REFERENCES account(account_id) ON DELETE CASCADE;


--
-- Name: account_recovery_account_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY account_recovery
    ADD CONSTRAINT account_recovery_account_id_fkey FOREIGN KEY (account_id) REFERENCES account(account_id) ON DELETE CASCADE;


--
-- Name: artist_genre_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY artist
    ADD CONSTRAINT artist_genre_id_fkey FOREIGN KEY (genre_id) REFERENCES genre(genre_id) ON DELETE CASCADE;


--
-- Name: booking_artist_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY booking
    ADD CONSTRAINT booking_artist_id_fkey FOREIGN KEY (artist_id) REFERENCES artist(artist_id) ON DELETE CASCADE;


--
-- Name: booking_party_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY booking
    ADD CONSTRAINT booking_party_id_fkey FOREIGN KEY (party_id) REFERENCES party(party_id) ON DELETE CASCADE;


--
-- Name: chat_account_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY chat
    ADD CONSTRAINT chat_account_id_fkey FOREIGN KEY (account_id) REFERENCES account(account_id) ON DELETE CASCADE;


--
-- Name: chat_organizer_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY chat
    ADD CONSTRAINT chat_organizer_id_fkey FOREIGN KEY (organizer_id) REFERENCES organizer(organizer_id) ON DELETE CASCADE;


--
-- Name: following_follower_account_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY following
    ADD CONSTRAINT following_follower_account_id_fkey FOREIGN KEY (follower_account_id) REFERENCES account(account_id) ON DELETE CASCADE;


--
-- Name: following_following_account_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY following
    ADD CONSTRAINT following_following_account_id_fkey FOREIGN KEY (following_account_id) REFERENCES account(account_id) ON DELETE CASCADE;


--
-- Name: following_following_party_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY following
    ADD CONSTRAINT following_following_party_id_fkey FOREIGN KEY (following_party_id) REFERENCES party(party_id) ON DELETE CASCADE;


--
-- Name: menu_party_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY menu
    ADD CONSTRAINT menu_party_id_fkey FOREIGN KEY (party_id) REFERENCES party(party_id) ON DELETE CASCADE;


--
-- Name: notification_account_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY notification
    ADD CONSTRAINT notification_account_id_fkey FOREIGN KEY (account_id) REFERENCES account(account_id) ON DELETE CASCADE;


--
-- Name: notification_message_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY notification
    ADD CONSTRAINT notification_message_id_fkey FOREIGN KEY (message_id) REFERENCES message(message_id) ON DELETE CASCADE;


--
-- Name: notification_party_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY notification
    ADD CONSTRAINT notification_party_id_fkey FOREIGN KEY (party_id) REFERENCES party(party_id);


--
-- Name: organizer_account_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY organizer
    ADD CONSTRAINT organizer_account_id_fkey FOREIGN KEY (account_id) REFERENCES account(account_id) ON DELETE CASCADE;


--
-- Name: party_genre_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY party
    ADD CONSTRAINT party_genre_id_fkey FOREIGN KEY (genre_id) REFERENCES genre(genre_id) ON DELETE CASCADE;


--
-- Name: party_information_party_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY party_information
    ADD CONSTRAINT party_information_party_id_fkey FOREIGN KEY (party_id) REFERENCES party(party_id);


--
-- Name: party_organizer_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY party
    ADD CONSTRAINT party_organizer_id_fkey FOREIGN KEY (organizer_id) REFERENCES organizer(organizer_id) ON DELETE CASCADE;


--
-- Name: party_photo_party_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY party_photo
    ADD CONSTRAINT party_photo_party_id_fkey FOREIGN KEY (party_id) REFERENCES party(party_id) ON DELETE CASCADE;


--
-- Name: purchase_account_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY purchase
    ADD CONSTRAINT purchase_account_id_fkey FOREIGN KEY (account_id) REFERENCES account(account_id) ON DELETE CASCADE;


--
-- Name: purchase_ticket_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY purchase
    ADD CONSTRAINT purchase_ticket_id_fkey FOREIGN KEY (ticket_id) REFERENCES ticket(ticket_id) ON DELETE CASCADE;


--
-- Name: rating_account_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY rating
    ADD CONSTRAINT rating_account_id_fkey FOREIGN KEY (account_id) REFERENCES account(account_id) ON DELETE CASCADE;


--
-- Name: rating_organizer_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY rating
    ADD CONSTRAINT rating_organizer_id_fkey FOREIGN KEY (organizer_id) REFERENCES organizer(organizer_id) ON DELETE CASCADE;


--
-- Name: rating_party_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY rating
    ADD CONSTRAINT rating_party_id_fkey FOREIGN KEY (party_id) REFERENCES party(party_id) ON DELETE CASCADE;


--
-- Name: ticket_party_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY ticket
    ADD CONSTRAINT ticket_party_id_fkey FOREIGN KEY (party_id) REFERENCES party(party_id) ON DELETE CASCADE;


--
-- Name: waiting_list_account_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY waiting_list
    ADD CONSTRAINT waiting_list_account_id_fkey FOREIGN KEY (account_id) REFERENCES account(account_id) ON DELETE CASCADE;


--
-- Name: waiting_list_ticket_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: michielswaanen
--

ALTER TABLE ONLY waiting_list
    ADD CONSTRAINT waiting_list_ticket_id_fkey FOREIGN KEY (ticket_id) REFERENCES ticket(ticket_id) ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

