declare type User = {
  id: number;
  name: string;
  email: string;
  initials: string;
  image_url?: string;
};

declare type Channel = {
  id: number;
  name: string | null;
  description: string | null;
  type: "direct" | "group";
  created_by: number;
  creator?: User;
  members_count?: number;
  members?: User[];
  updated_at: string;
};
