package main

import (
	"flag"
	"log"

	"golang.org/x/net/context"
	"google.golang.org/grpc"

	pb "github.com/nickschuch/articles"
)

var (
	serverAddr = flag.String("api", "127.0.0.1:8080", "The server address in the format of host:port")
)

func main() {
	flag.Parse()

	var opts []grpc.DialOption

	// This is insecure, not for production!
	opts = append(opts, grpc.WithInsecure())

	conn, err := grpc.Dial(*serverAddr, opts...)
	if err != nil {
		log.Fatalf("Fail to dial: %v", err)
	}
	defer conn.Close()

	client := pb.NewArticlesClient(conn)

	articles := []*pb.Article{
		&pb.Article{
			Title: "The 10 Most Beautiful Cheeses From Politicians in 2013",
			Body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
		},
		&pb.Article{
			Title: "29 Painful Truths Only Wolves Will Understand",
			Body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
		},
		&pb.Article{
			Title: "The 26 Most Courageous Cars On Mars",
			Body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
		},
		&pb.Article{
			Title: "The 31 Most Adorable Corporations Of Last Summer",
			Body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
		},
		&pb.Article{
			Title: "50 Problems Only Kardashians Will Understand",
			Body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
		},
		&pb.Article{
			Title: "The 17 Most Disturbing GIFs Of The '90s",
			Body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
		},
		&pb.Article{
			Title: "The 35 Most Wanted Costumes Of Your Childhood",
			Body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
		},
		&pb.Article{
			Title: "The 24 Cheesiest Advertisements On The Moon",
			Body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
		},
		&pb.Article{
			Title: "The 37 Biggest Potatoes From Around The World",
			Body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
		},
		&pb.Article{
			Title: "33 Atlanta Falcons Who Are Clearly Being Raised Right",
			Body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
		},
		&pb.Article{
			Title: "19 Tweets That Will Restore Your Faith In The Internet",
			Body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
		},
		&pb.Article{
			Title: "The 45 Most Important HBO Shows Of 2013",
			Body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
		},
		&pb.Article{
			Title: "The 41 Husky Puppies That Will Haunt Your Dreams",
			Body:  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
		},
	}

	// Seed the API with our data from above.
	for _, article := range articles {
		_, err := client.Create(context.Background(), &pb.CreateRequest{Article: article})
		if err != nil {
			log.Println("Failed to create article:", article.Title, err)
			continue
		}

		log.Println("Created article:", article.Title)
	}
}
