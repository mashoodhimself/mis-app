<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentHeader from '../Components/ContentHeader.vue';
import { defineProps } from 'vue';

const props = defineProps({
    feeds: Object,
});

</script>

<template>
    <AppLayout>
    <ContentHeader title="Annoucements" />
    <section class="content">
        <div class="container-fluid">
           
            <div class="row">
                <div class="col-md-12">

                        <div v-for="feed in feeds.data" :key="feed.id" class="container">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h4 class="card-title font-weight-bold text-primary">{{ feed.title  }}</h4>
                                    <p class="card-text text-muted">{{ feed.description }}</p>
                                    <hr>
                                    <div class="mb-0 text-right text-secondary d-flex justify-content-between">
                                            <div v-if="$page.props.auth.user.role === feed.user_id" class="actionButtons">
                                                <a class="text-secondary" href="/feed/edit/{{ $feed->id }}"><i class="fas fa-edit"></i></a>
                                                <a onclick="if(confirm('Are you sure to delete this feed ?')){document.getElementById('feed-{{ $feed->id }}').submit();}" class="text-danger" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                                            </div>
                                        <small>Posted by <strong>{{ feed.user.name }}</strong></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="flex gap-2 mt-4" >
                            <template v-for="link in feeds.links" :key="link.label">
                                <button
                                    v-if="link.url"
                                    @click="$inertia.get(link.url)"
                                    :class="{ 'font-bold underline': link.active }"
                                    v-html="link.label"
                                />
                                <span v-else v-html="link.label" class="text-gray-400" />
                            </template>
                        </div> -->


                </div>
            </div>

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </AppLayout>
</template>