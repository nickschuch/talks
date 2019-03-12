package main

import (
	"flag"
	"fmt"
	"log"

	"github.com/gosuri/uitable"
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

	// Query and print out all the data that lives in the
	resp, err := client.List(context.Background(), &pb.ListRequest{})
	if err != nil {
		log.Fatalf("Failed to list articles:", err)
	}

	table := uitable.New()
	table.MaxColWidth = 50

	table.AddRow("ID", "TITLE", "BODY")
	for _, article := range resp.Articles {
		table.AddRow(article.Id, article.Title, article.Body)
	}

	fmt.Println(table)
}
