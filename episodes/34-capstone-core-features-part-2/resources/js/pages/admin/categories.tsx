import { Form, Head } from '@inertiajs/react';
import CategoryController from '@/actions/App/Http/Controllers/Admin/CategoryController';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { index } from '@/routes/admin/categories';

type Category = {
    id: number;
    name: string;
    archived: boolean;
    tickets_count: number;
};

export default function Categories({ categories }: { categories: Category[] }) {
    return (
        <>
            <Head title="Categories" />
            <div className="flex max-w-3xl flex-1 flex-col gap-6 p-4">
                <Heading
                    title="Categories"
                    description="Archived categories can't be picked for new tickets. Existing tickets keep them."
                />

                <Form
                    {...CategoryController.store.form()}
                    resetOnSuccess
                    className="flex flex-col gap-2 sm:flex-row sm:items-end"
                >
                    {({ processing, errors }) => (
                        <>
                            <div className="grid flex-1 gap-2">
                                <Label htmlFor="new-category">
                                    New category
                                </Label>
                                <Input
                                    id="new-category"
                                    name="name"
                                    required
                                    maxLength={100}
                                />
                                <InputError message={errors.name} />
                            </div>
                            <Button disabled={processing}>Create</Button>
                        </>
                    )}
                </Form>

                <ul className="divide-y rounded-xl border">
                    {categories.map((category) => (
                        <li key={category.id} className="space-y-3 p-4">
                            <div className="flex flex-wrap items-center gap-2">
                                <span className="font-medium">
                                    {category.name}
                                </span>
                                {category.archived && (
                                    <Badge variant="secondary">archived</Badge>
                                )}
                                <span className="text-sm text-muted-foreground">
                                    {category.tickets_count}{' '}
                                    {category.tickets_count === 1
                                        ? 'ticket'
                                        : 'tickets'}
                                </span>
                            </div>
                            <div className="flex flex-col gap-2 sm:flex-row sm:items-start">
                                <Form
                                    {...CategoryController.update.form(
                                        category.id,
                                    )}
                                    options={{ preserveScroll: true }}
                                    className="flex flex-1 gap-2"
                                >
                                    {({ processing, errors }) => (
                                        <div className="grid flex-1 gap-1">
                                            <div className="flex gap-2">
                                                <Input
                                                    name="name"
                                                    aria-label={`Rename ${category.name}`}
                                                    defaultValue={category.name}
                                                    required
                                                    maxLength={100}
                                                />
                                                <Button
                                                    variant="outline"
                                                    disabled={processing}
                                                >
                                                    Rename
                                                </Button>
                                            </div>
                                            <InputError message={errors.name} />
                                        </div>
                                    )}
                                </Form>
                                {!category.archived && (
                                    <Form
                                        {...CategoryController.archive.form(
                                            category.id,
                                        )}
                                        options={{ preserveScroll: true }}
                                    >
                                        {({ processing }) => (
                                            <Button
                                                variant="secondary"
                                                disabled={processing}
                                            >
                                                Archive
                                            </Button>
                                        )}
                                    </Form>
                                )}
                            </div>
                        </li>
                    ))}
                </ul>
            </div>
        </>
    );
}

Categories.layout = {
    breadcrumbs: [{ title: 'Categories', href: index() }],
};
